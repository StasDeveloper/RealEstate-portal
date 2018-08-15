<?php

/**
 * Command set to queue for recalculating wrong estimated price
 *  ./yiic CronRecalcPrice
 */
class CronRecalcPriceCommand extends CConsoleCommand {

    public function run() {
        $this->writeToLog("\r\n Start ClearCoord at ". date('Y-m-d H:i:s'));    
        $this->clearCoord();
        $this->writeToLog('Finished ClearCoord at '. date('Y-m-d H:i:s'));
    }
    
    private function writeToLog($content) {
        $filename = Yii::app()->basePath.'/runtime/cronRecalcPricelog.txt';
        $fp = fopen($filename, 'a');
        if($fp){
            fwrite($fp, $content."\r\n");
        }
        
        fclose($fp); 
    }
    
    public function clearCoord(){
        $start = time();
        $ids = Yii::app()->db->createCommand("
SELECT `property_info`.`property_zipcode`
FROM  `property_info` 
WHERE  `estimated_price` =0
AND property_info.getlongitude !=  '0.000000'
AND property_info.getlatitude !=  '0.000000'
AND UPPER(  `property_info`.`property_status` ) =  'ACTIVE'
GROUP BY  `property_info`.`property_zipcode`
        ")->queryAll();
        $this->writeToLog("Total ".count($ids)." rec. ");
//print_r($ids);
        if ( $ids !== false ){
            foreach ($ids as $key => $value) {
                if(Yii::app()->db->createCommand($r="
                    INSERT INTO `bucontra_propertyhookup`.`property_info_cron_estimated_price`
                        (`property_zipcode`) VALUES
                        ('{$value['property_zipcode']}')
                ")->execute()) {
// echo $r, PHP_EOL;            
                } else {
                    $this->writeToLog('ERROR in ' . $r);
                }
            }
            $end = time();
            $query_took = $end-$start;
            $this->writeToLog("Query took ".$query_took." sec. ");
        } else {
            $this->writeToLog("Error");
        }
    }
    
}
