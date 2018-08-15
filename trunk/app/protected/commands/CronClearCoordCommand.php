<?php

/**
 * Command for clear wrong coordinates
 *  ./yiic CronClearCoord
 */
class CronClearCoordCommand extends CConsoleCommand {

    public function run() {
        $this->writeToLog("\r\n Start ClearCoord at ". date('Y-m-d H:i:s'));    
        $this->clearCoord();
        $this->writeToLog('Finished ClearCoord at '. date('Y-m-d H:i:s'));
    }
    
    private function writeToLog($content) {
        $filename = Yii::app()->basePath.'/runtime/cronCoordlog.txt';
        $fp = fopen($filename, 'a');
        if($fp){
            fwrite($fp, $content."\r\n");
        }
        
        fclose($fp); 
    }
    
    public function clearCoord(){
        $start = time();
        $ids = Yii::app()->db->createCommand("
SELECT DISTINCT `property_id`, `property_zipcode`, zipcode.zip_code, mls_glvar_property.t0_sysid , mls_glvar_property.t10_zip_code
FROM `property_info` left join zipcode ON zipcode.zip_id=property_info.`property_zipcode` 
left join mls_glvar_property ON mls_glvar_property.t0_sysid = property_info.mls_sysid
WHERE mls_glvar_property.t0_sysid > 0 and zipcode.zip_code != mls_glvar_property.t10_zip_code 
AND UPPER(`property_info`.`property_status`)='ACTIVE' 
AND getlongitude != 0.0 AND getlatitude != 0.0
        ")->queryAll();
        $this->writeToLog("Total ".count($ids)." rec. ");
//print_r($ids);
        if ( $ids !== false ){
            foreach ($ids as $key => $value) {
                $zipIds = Yii::app()->db->createCommand(
                "SELECT county.state_id,city.county_id,city.cityid, zipcode.zip_id FROM zipcode INNER JOIN city ON zipcode.cityid = city.cityid INNER JOIN county ON city.county_id=county.county_id where zip_code='{$value['t10_zip_code']}'"
                )->queryRow();
//print_r($zipIds);
                if($zipIds) {
                    if(Yii::app()->db->createCommand($r="
                        UPDATE `property_info` set 
                        getlongitude = 0.0,
                        getlatitude = 0.0,
                        property_state_id = {$zipIds['state_id']},
                        property_county_id = {$zipIds['county_id']},
                        property_city_id = {$zipIds['cityid']},
                        property_zipcode = {$zipIds['zip_id']}
                        WHERE `property_info`.`property_id` = {$value['property_id']}
                    ")->execute()) {
// echo $r, PHP_EOL;            
                    } else {
                        $this->writeToLog('ERROR in ' . $r);
                    }
                } else {
//print_r($value);
                    $this->writeToLog('undefined zip ' . $value['t10_zip_code'] . ' property_id=' . $value['property_id']);
                    if(Yii::app()->db->createCommand($r="
                        UPDATE `property_info` set 
                        property_status = 'Inactive'
                        WHERE `property_info`.`property_id` = {$value['property_id']}
                    ")->execute()) {
// echo $r, PHP_EOL;            
                    } else {
                        $this->writeToLog('ERROR in ' . $r);
                    }
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
