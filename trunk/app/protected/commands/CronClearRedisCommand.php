<?php

/**
 * Command set to reserch the factors for recalculating estimated price
 *  ./yiic CronReloadFactors
 *  ./yiic CronReloadFactors last30day
 *  ./yiic CronReloadFactors research last30day -- only closed status
 *  ./yiic CronReloadFactors research -- only closed status
 *  ./yiic CronReloadFactors recalc
 *  ./yiic CronReloadFactors recalc last30day
 */
class CronClearRedisCommand extends CConsoleCommand {

    public function run($args = array()) {
//        ini_set("memory_limit","256M");
        $start = time();
        $this->writeToLog("Start cronClearRedis at ". date('Y-m-d H:i:s', $start)); 

            Yii::app()->redisCache->executeCommand('FLUSHDB',array()); // $this->busyRedisId
            
        $end = time();
        $this->writeToLog('Finished cronClearRedis at '. date('Y-m-d H:i:s', $end) . ' time=' . SiteHelper::timeElapsed($end-$start));
    }
    
    private function writeToLog($content) {
        $filename = Yii::app()->basePath.'/runtime/cronClearRedis.log';
        $fp = fopen($filename, 'a');
        if($fp){
            fwrite($fp, $content."\r\n");
        }
        
        fclose($fp); 
    }
    

}
