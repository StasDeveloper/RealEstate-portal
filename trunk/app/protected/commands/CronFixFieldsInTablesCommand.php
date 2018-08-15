<?php

/**
 * Command set to queue for recalculating wrong estimated price
 *  ./yiic ReplaceTheOddWhitespaces
 */
class CronFixFieldsInTablesCommand extends CConsoleCommand {

    private $offsetValueRedis = 'FixFieldsInTablesOffset_Value';
    private $workStatusRedis = 'FixFieldsInTables_WorkStatus';
    private $totalCount = 'FixFieldsInTables_TotalCount';
    private $isWork = 'runned';
    private $sqlLimit = 20000;
    private $ready = "readyToStep";
    private $targetTable = 'property_info';
    private $targetValues = 'property_id, property_street';

    public function run() {
        $this->writeToLog("\r\n Start ReplaceTheOddWhitespaces at ". date('Y-m-d H:i:s'));
        $startValue = 0;

        $workStatus = Yii::app()->redisCache->executeCommand('GET', array($this->workStatusRedis));

        if($workStatus == null || $workStatus == 'readyToStep' ){

            Yii::app()->redisCache->executeCommand('SETEX', array($this->workStatusRedis, 10800, $this->isWork));

            $workValue = Yii::app()->redisCache->executeCommand('GET', array($this->offsetValueRedis));
            $startValue = (isset($workValue) && $workValue != null) ? $workValue : 0;
            if(!(isset($workValue) && $workValue != null)){
                $sql = "SELECT COUNT(property_id) as count FROM ".$this->targetTable;
                $command = Yii::app()->db->createCommand($sql);
                $results = $command->queryRow();
                Yii::app()->redisCache->executeCommand('SETEX', array($this->totalCount, 50000, $results['count']));
            }
            $total = Yii::app()->redisCache->executeCommand('GET', array($this->totalCount));

        } elseif ($workStatus == $this->ready){

            $this->writeToLog('ReplaceTheOddWhitespaces is finished');
            return;
        } else {

            $this->writeToLog('Runned ReplaceTheOddWhitespaces');
            return;
        }

        $this->replaceWhitespaces($startValue,$total);
        $this->writeToLog('Finished ReplaceTheOddWhitespaces at '. date('Y-m-d H:i:s'));
    }

    private function writeToLog($content) {
        $filename = Yii::app()->basePath.'/runtime/cronReplaceTheOddWhitespaces.txt';
        $fp = fopen($filename, 'a');
        if($fp){
            fwrite($fp, $content."\r\n");
        }

        fclose($fp);
    }

    public function replaceWhitespaces($startValue = null, $total = null){

        ini_set("memory_limit","512M");
        $errorsCount = 0;
        $values = Yii::app()->db->createCommand()
            ->select($this->targetValues)
            ->from($this->targetTable)
//            ->offset($startValue)
//            ->limit($this->sqlLimit)
            ->queryAll();
        foreach ($values as $value){
            $startValue++;
            $updateArray = array();
            foreach ($value as $k=>$v) {
                if($k != 'property_id'){
                    if($errorValue = $this->checkValue($v)){
                        $errorsCount++;
                        $infoStr = "\r\n Structural damage of value was found in table: ".$this->targetTable." -> Property: ".$value['property_id']." -> Field: ".$k.' - Incorrect value: '.$errorValue['string'].PHP_EOL;
                        $this->writeToLog($infoStr);
                        echo $infoStr;
                        do {
                            $v = preg_replace('/'.$errorValue["matches"].'/', '', trim($v));

                        } while ($errorValue = $this->checkValue($v));

                        $updateArray[$k] = $v;
                        Yii::app()->db->createCommand()
                            ->update(
                                $this->targetTable,
                                $updateArray,
                                'property_id=:property_id',
                                array(':property_id'=>$value['property_id'])
                            );
                        $infoStr = "\r\n Error in value structure was fixed".PHP_EOL;
                        $this->writeToLog($infoStr);
                        echo $infoStr;
                    }
                }
            }
            unset($updateArray);
            if($startValue >= $total) {
                if($errorsCount == 0){
                    $infoStr = "\r\n Errors was not found! Nice day for you!".PHP_EOL;
                    $this->writeToLog($infoStr);
                    echo $infoStr;
                } else {
                    $infoStr = "\r\n Work on corrections is completed. Total errors fixed: ". $errorsCount.PHP_EOL;
                    $this->writeToLog($infoStr);
                    echo $infoStr;
                }

                Yii::app()->redisCache->executeCommand('DEL', array($this->workStatusRedis));
                Yii::app()->redisCache->executeCommand('DEL', array($this->offsetValueRedis));
                Yii::app()->redisCache->executeCommand('DEL', array($this->totalCount));
//                Yii::app()->redisCache->executeCommand('SET', array($this->workStatusRedis,'finished'));
                return;
            }
        }
        Yii::app()->redisCache->executeCommand('SETEX', array($this->workStatusRedis, 10800, $this->ready));
        Yii::app()->redisCache->executeCommand('SETEX', array($this->offsetValueRedis, 10800, $startValue));

    }
    private function checkValue($v) {

        if(preg_match_all('/ none| n\/a| 0|  +| na/',$v,$matches)){
            $matchesStr ='';
            foreach ($matches as $match){
                $matchesStr .= implode('|',$match);
            }
            $result = array('matches'=>str_replace('/','\/',$matchesStr), 'string'=>$matchesStr);
            return $result;
        }

        return false;
    }

}
