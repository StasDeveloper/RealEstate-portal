<?php

/**
 * Reload all photo from 2 days
 *  ./yiic CronReLoadPhoto
 */
class CronReLoadPhotoCommand extends CConsoleCommand {

    public function run() {
        $this->writeToLog("\r\n Start ReLoadPhoto at ". date('Y-m-d H:i:s'));    
        $this->clearCoord();
        $this->writeToLog('Finished ReLoadPhoto at '. date('Y-m-d H:i:s'));
    }
    
    private function writeToLog($content) {
        $filename = Yii::app()->basePath.'/runtime/cronReLoadPhoto.log';
        $fp = fopen($filename, 'a');
        if($fp){
            fwrite($fp, $content."\r\n");
        }
        
        fclose($fp); 
    }
    
    public function clearCoord(){
        $start = time();
        $ids = Yii::app()->db->createCommand("
SELECT `property_info`.`mls_sysid`
FROM  `property_info` 
WHERE `mls_name` IS NOT NULL 
GROUP BY  `property_info`.`mls_sysid`
        ")->queryAll();
        $this->writeToLog("Total ".count($ids)." rec. ");
//print_r($ids);
        if ( $ids !== false ){
            foreach ($ids as $key => $value) {
                if(Yii::app()->db->createCommand($r="
                    INSERT IGNORE INTO `bucontra_propertyhookup`.`tbl_property_info_cron_load_photo`
                        (`mls_sysid`) VALUES
                        ('{$value['mls_sysid']}')
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
