<?php

/**
 * Command set to reserch the factors for recalculating estimated price
 *  ./yiic CronReloadFactors
 *  ./yiic CronReloadFactors last30day
 *  ./yiic CronReloadFactors research last30day -- only closed status
 *  ./yiic CronReloadFactors research -- only closed status
 *  ./yiic CronReloadFactors recalc
 *  ./yiic CronReloadFactors recalc optimal
 *  ./yiic CronReloadFactors recalc last30day
 *  ./yiic CronReloadFactors reset -- reset IsBusy on Redis
 *  ./yiic CronReloadFactors recalc byzip -- for_aws script
 */
class CronReloadFactorsCommand extends CConsoleCommand {
    private $date30 = '';
    private $research = false;
    private $recalc = false;
    private $optimal = false;
    private $byZip = false;
    public $tail = false;
    
    private $maxRecalcRec = 3000;
    
    private $busyRedisId = 'reloadFactorsIsBusy'; // name in Redis
    private $busyRedisTimeout = 86400; // sec // 24 hours
    private $reset = false;

    public function run($args = array()) {
        ini_set("memory_limit","200M");
        $this->getParams($args);
        $start = time();

        if($this->byZip) {
            $this->busyRedisId = 'reloadFactorsIsBusyByZip';
            $this->busyRedisTimeout = 3600;
        }
        
        if($this->reset) {
            Yii::app()->redisCache->executeCommand('DEL',array($this->busyRedisId)); // $this->busyRedisId
        }

        if( !($oldStart = $this->checkIsBusy()) /* || true */ ) {
//            Yii::app()->redisCache->executeCommand('SET',array($this->busyRedisId,$start,$this->busyRedisTimeout));
            if(Yii::app()->redisCache->executeCommand('SETNX',array($this->busyRedisId,$start)))
            {
                Yii::app()->redisCache->executeCommand('EXPIRE',array($this->busyRedisId,$this->busyRedisTimeout));
            }
            $this->writeToLog("Start " . $this->getMode() . " at ". date('Y-m-d H:i:s', $start)); 

        
            if($this->research) {
                $this->researchFactors();
            } else {
                if($this->byZip) {
                    $this->reloadFactorsByZIP();
                } else {
                    $this->reloadFactors();
                }
            }

            Yii::app()->redisCache->executeCommand('DEL',array($this->busyRedisId));

        } else {
            $this->writeToLog("Another copy of the script executed more : time=" . SiteHelper::timeElapsed($start-$oldStart));
            echo 'Another copy of the script executed more : time=' . SiteHelper::timeElapsed($start-$oldStart), PHP_EOL;
        }
        if(!$oldStart) {
            $end = time();
            $this->writeToLog('Finished ' . $this->getMode() . ' at '. date('Y-m-d H:i:s', $end) . ' time=' . SiteHelper::timeElapsed($end-$start) . ' max memory=' . memory_get_peak_usage());
        }
    }
    
    private function writeToLog($content) {
        if($this->byZip) {
            $filename = Yii::app()->basePath.'/runtime/cronReloadFactorsByZip.log';
        } else {
            $filename = Yii::app()->basePath.'/runtime/cronReloadFactors.log';
        }
        $fp = fopen($filename, 'a');
        if($fp){
            fwrite($fp, $content."\r\n");
        }
        
        fclose($fp); 
    }
    
    public function reloadFactors($status=''){
        $date30where = '';
        if(!empty($this->date30)) {
            $date30where = " AND property_info.property_updated_date>=DATE('{$this->date30}')";
        }
        $statusWhere = "";
        if(!empty($status)) {
            $statusWhere = " AND property_info.estimated_price >0 
                             AND (property_info_additional_brokerage_details.status ='Closed'
                               OR property_info_additional_brokerage_details.status ='Leased'
                               OR property_info_additional_brokerage_details.status ='Sold')";
        }
        $optimalWhere = '';
        $maxEstimatedPriceRecalc = isset(Yii::app()->params['maxEstimatedPriceRecalc'])? Yii::app()->params['maxEstimatedPriceRecalc'] : 2;
        if(!empty($this->optimal) ) {
            $optimalWhere = " AND `estimated_price_recalc_at` <= DATE_ADD(CURDATE(), INTERVAL -{$maxEstimatedPriceRecalc} DAY) AND `property_type` NOT IN (0,4,5) ";
        }
        $start = time();
//        $maxRecalcRec = 5000; // 10000
        $lastPropertyId = 0;
        $cycle = 0;
        do {
            $cycle++;
            $ids = Yii::app()->db->createCommand($sql="
SELECT 
    `property_info`.`property_id`,
    `fundamentals_factor`,
    `conditional_factor`,
    `property_type`,
    `property_zipcode`,
    `compass_point`,
    `house_faces`,
    `house_views`,
    `street_name`,
    `pool`,
    `spa`,
    `stories`,
    `lot_description`,
    `building_description`,
    `carport_type`,
    `converted_garage`,
    `exterior_structure`,
    `roof`,
    `electrical_system`,
    `plumbing_system`,
    `built_desc`,
    `exterior_grounds`,
    `prop_desc`,
    `over_all_property`,
    `foreclosure`,
    `short_sale`,
    `sub_type`,

    `studio`,
    `condo_conversion`,
    `association_features_available`,
    `association_fee_1`,
    `assessment`,
    `sidlid`,
    `parking_description`,
    `fence_type`,
    `court_approval`,
    `bath_downstairs`,
    `bedroom_downstairs`,
    `great_room`,
    `bath_downstairs_description`,
    `flooring_description`,
    `furnishings_description`,
    `heating_features`,
    `possession_description`,
    `financing_considered`,
    `reporeo`,
    `litigation`
FROM
    `property_info`
LEFT JOIN `property_info_details` USING (`property_id` )
LEFT JOIN `property_info_additional_details` USING (`property_id` )
LEFT JOIN `property_info_additional_brokerage_details` USING (`property_id` )
WHERE
    UPPER(`property_info`.`property_status`)='ACTIVE'
    {$optimalWhere}
     AND property_info.property_id > {$lastPropertyId} {$date30where} {$statusWhere}
LIMIT 0, {$this->maxRecalcRec}
        ")->queryAll();
// $this->writeToLog($sql); // `property_info`.`property_id` IN (5562080,5504921,5504927) AND 
            if ( $ids !== false ){
                $count_rows = count($ids);
                $sum_time = 0;
                if($count_rows > 0) {
                    $this->writeToLog("$cycle: Total ". $count_rows ." rec. ");
                    foreach ($ids as $key => $value) {
                        $lastPropertyId = $value['property_id'];
                        $factors = $this->getFactors($value);
                        if(!empty($factors)) {
                            PropertyInfo::model()->updateByPk($value['property_id'],$factors);
                            if($this->research || $this->recalc) {
$time_start = microtime(TRUE);
                                $this->recalcEstimatedPrice($value['property_id']);
$time_end = microtime(TRUE);
$time = $time_end - $time_start;
$sum_time += $time;
//$this->writeToLog1("{$value['property_id']} = $time");
                            }
                        }
//                    if($key % 1000 === 0){
//                        $end = time();
//                        $this->writeToLog($cycle.': '.$key." from ".$count_rows. " property_id=$lastPropertyId time=" . SiteHelper::timeElapsed($end-$start));
//                    }
                    }
                    $this->writeToLog("AVG time=". ($sum_time/$count_rows));
                }
            } else {
                $this->writeToLog("Error");
            }
        } while ( $ids && $count_rows );
    }

    private function getFactorsOld($property) {
        $factors = array('fundamentals_factor'=>0.0, 'conditional_factor'=>0.0 );
        $whereStr = MarketTrendTable::searchFactors( $property );
        $whereParam = MarketTrendTable::searchFactorsParam( $property );
        if(!empty($whereStr)) {
            foreach (array('fundamentals_factor', 'conditional_factor') as $factor) {
                $critFactor = new CDbCriteria();
                $critFactor->condition = "($factor IS NOT NULL AND $factor != 0.0 ) AND " . $whereStr ;
                $critFactor->params = $whereParam;
//                $critFactor->select = "AVG($factor) as 'fundamentals_factor'";
                $critFactor->select = "SUM($factor) as 'fundamentals_factor'";

                $factorObj = MarketTrendTable::model()->find($critFactor);

                if(isset($factorObj->fundamentals_factor)) {
                    $factors[$factor] = $factorObj->fundamentals_factor;
                }
            }
//Yii::log(print_r($factors,1 ) ,'ERROR'); 
        }
        return $factors;
    }

    private function getFactors($property) {
//        $factors = array('fundamentals_factor'=>0.0, 'conditional_factor'=>0.0 );
        $factors = MarketTrendTable::getFactors( $property );
        return $factors;
    }

    public function researchFactors() {
//$this->writeToLog('1 max memory=' . memory_get_peak_usage());
        $cycleMax = isset(Yii::app()->params['maxCyclesResearch'])? Yii::app()->params['maxCyclesResearch'] : 5;
        $precision = isset(Yii::app()->params['maxPrecisionResearch'])? Yii::app()->params['maxPrecisionResearch'] : 0.01;
        $date30where = '';
        $stdCreterian = "(property_info.estimated_price >0 AND 
                          UPPER(`property_info`.`property_status`)='ACTIVE' AND
                         (property_info_additional_brokerage_details.status ='Closed' OR 
                         property_info_additional_brokerage_details.status ='Sold' OR 
                         property_info_additional_brokerage_details.status ='LEASED'))";
        
        if(!empty($this->date30)) {
            $date30where = " AND property_info.property_updated_date>=DATE('{$this->date30}')";
        }
        $cycle = 1;
//            $this->reloadFactors('Closed');

        do {
//$this->writeToLog('1-0 max memory=' . memory_get_peak_usage());
            $avg_percentage_diff_max = 0.0;
            $avg_percentage_diff_max_id = -1;
            $start =  time();

            $this->writeToLog($cycle. ' : Step 1');
            
//        $maxRecalcRec = 5000; // 10000
        $lastMarketId = 0;
        $cycleMarket = 0;
        do {
            $cycleMarket++;
            $count_rows = 0;
            
//    property_info.property_id > {$lastPropertyId} {$date30where} {$statusWhere}
//LIMIT 0, {$this->maxRecalcRec}

            $marketTrends = MarketTrendTable::model()
                    ->findAll(array(
                     'condition' => 't.id > :id',
                     'limit' => $this->maxRecalcRec,
                     'params' => array(':id'=>$lastMarketId),
                    ));
            if ( $marketTrends !== false ){
                $count_rows = count($marketTrends);

                if($count_rows > 0) {
                    $this->writeToLog("MarketCycle $cycleMarket: Total ". $count_rows ." rec. ");

            foreach ($marketTrends as $marketTrend) {
//$this->writeToLog('1-0-0 max memory=' . memory_get_peak_usage());
                $lastMarketId = $marketTrend->id;
                $marketTrendWhereStr = MarketTrendTable::searchProperties( $marketTrend );
                $marketTrendWhereParam = MarketTrendTable::searchPropertiesParam( $marketTrend );
//$this->writeToLog(print_r($marketTrendWhereStr,1 ) ); 
//$this->writeToLog(print_r($marketTrendWhereParam,1 ) ); 
                $avgsQuery = Yii::app()->db->createCommand()
                        ->select('AVG(property_info.percentage_depreciation_value) as avg_percentage_diff, COUNT(property_info.percentage_depreciation_value) as t_count')
                        ->from('property_info')
                        ->leftJoin('property_info_details','property_info.property_id = property_info_details.property_id')
                        ->leftJoin('property_info_additional_details','property_info.property_id = property_info_additional_details.property_id')
                        ->leftJoin('property_info_additional_brokerage_details','property_info.property_id = property_info_additional_brokerage_details.property_id');
                if(!empty($marketTrendWhereStr)) {
                    $avgsQuery->where("{$stdCreterian} {$date30where} AND $marketTrendWhereStr ", $marketTrendWhereParam);
                } else {
                    $avgsQuery->where("{$stdCreterian} {$date30where}");
                }
                $avgs = $avgsQuery->queryRow();
                if(!empty($avgs)) {
                    if(abs($avgs['avg_percentage_diff']) > $avg_percentage_diff_max) {
                        $avg_percentage_diff_max = abs($avgs['avg_percentage_diff']);
                        $avg_percentage_diff_max_id = $marketTrend['id'];
                    }
                    if($marketTrend['factor_value'] > 0 ) {
                        $avg_percentage_diff_f = ((100-$avgs['avg_percentage_diff'])/ 100 );
                        $avgs['factor_value'] = $marketTrend['factor_value'] * ((100-$avgs['avg_percentage_diff'])/ 100 );
                    } else {
                        $avg_percentage_diff_f = ((100+$avgs['avg_percentage_diff'])/ 100 );
                        $avgs['factor_value'] = $marketTrend['factor_value'] * ((100+$avgs['avg_percentage_diff'])/ 100 );
                    }
                    $avgs = $this->checkLimitFactors($avgs, $marketTrend);
//if($avg_percentage_diff_f != 1 || $avg_percentage_diff_c != 1) {                    
//$this->writeToLog1(print_r(array($avg_percentage_diff_f,$avg_percentage_diff_c),1) );
//$this->writeToLog1(print_r(array($marketTrend['id'],$marketTrend['fundamentals_factor'],$marketTrend['conditional_factor']),1) );
//$this->writeToLog1(print_r($avgs,1) );
//}
if($this->signPlus($marketTrend['factor_value']) != $this->signPlus($avgs['factor_value'])) {
    $this->writeToLog('Changed sign : id=' . $marketTrend['id']);
}

                }
                if(!empty($avgs)) {
                    $avgs['updated_at'] = new CDbExpression('NOW()');
                    MarketTrendTable::model()->updateByPk($marketTrend['id'],$avgs);
                }
//$this->writeToLog('1-0-1 max memory=' . memory_get_peak_usage());
            }
            unset($avgsQuery);
            unset($avgs);
                }
            unset($marketTrends);
            }
        } while ( $count_rows );
            
            $end = time();
            $this->writeToLog("$cycle : End Step 1 avg_percentage_diff_max=$avg_percentage_diff_max (id=$avg_percentage_diff_max_id) time=" . SiteHelper::timeElapsed($end-$start));
            $start =  $end;
            $this->writeToLog($cycle. ' : Step 2');
//$this->writeToLog('1-1 max memory=' . memory_get_peak_usage());
            $this->reloadFactors('Closed');
//$this->writeToLog('1-2 max memory=' . memory_get_peak_usage());
            $end = time();
            $this->writeToLog($cycle. ' : End Step 2 time=' . SiteHelper::timeElapsed($end-$start));
        } while (($cycle++) < $cycleMax && $avg_percentage_diff_max > $precision);
//$this->writeToLog('1-3 max memory=' . memory_get_peak_usage());
    }

    private function checkLimitFactors($avgs, $marketTrend) {
        if(isset($avgs['factor_value'])) {
            if($avgs['factor_value'] > $marketTrend['factor_max']) {
                $avgs['factor_value'] = $marketTrend['factor_max'];
            }
            if($avgs['factor_value'] < $marketTrend['factor_min']) {
                $avgs['factor_value'] = $marketTrend['factor_min'];
            }
        }
        return $avgs;
    }
    
    public function recalcPrices($status=''){
        $date30where = '';
        if(!empty($this->date30)) {
            $date30where = " AND property_info.property_updated_date>=DATE('{$this->date30}')";
        }
        $statusWhere = "";
        if(!empty($status)) {
            $statusWhere = " AND property_info_additional_brokerage_details.status ='Closed'";
        }
    }

    public function recalcEstimatedPrice($id){
            $details = PropertyInfo::model()->with(
//                        'propertyInfoAdditionalBrokerageDetails',
//                        'propertyInfoAdditionalDetails',
                        'propertyInfoDetails'
                        )->findByPk($id);
            if (!empty($details) && ($details->getlatitude != 0.000000) && ($details->getlongitude != 0.000000)) {
                $estimatedValues = EstimatedPrice::getComparePropertyInfo(
                                                                    '', 
                                                                    $details->property_id, 
                                                                    $details->property_type, 
                                                                    $details->property_zipcode, 
                                                                    $details->getlatitude, 
                                                                    $details->getlongitude, 
                                                                    $details->year_biult_id, 
                                                                    $details->lot_acreage, 
                                                                    $details->house_square_footage, 
                                                                    $details->bathrooms, 
                                                                    $details->garages, 
                                                                    $details->pool, 
                                                                    $details->percentage_depreciation_value, 
                                                                    $details->estimated_price,
                                                                    $details->bedrooms,
                                                                    $details->subdivision, $details->fundamentals_factor, $details->conditional_factor
                                                                    , !empty($details->propertyInfoDetails->house_views)?$details->propertyInfoDetails->house_views:''
                                                                    , $details->sub_type
                                                                    , $details->property_price
                            );
//Yii::log(print_r($estimatedValues,1) ,'ERROR');
                if(!empty($estimatedValues)) {
//Yii::log(print_r($factors,1 ) ,'ERROR'); 
                        $updValues = array(
                                'estimated_price'=>$estimatedValues['estimated_value_subject_property'],
                                'percentage_depreciation_value'=>$estimatedValues['percentage_depreciation_value'],
                                'comp_stage'=>$estimatedValues['current_stage'],
                                'low_range'=>$estimatedValues['low_range'],
                                'high_range'=>$estimatedValues['high_range'],
                                'comps'=>$estimatedValues['comps'],
                                'house_square_footage_gravity'=>!empty($estimatedValues['result_query'])?$estimatedValues['result_query']->house_square_footage_gravity:0.0,
                                'lot_footage_gravity'=>!empty($estimatedValues['result_query'])?$estimatedValues['result_query']->lot_footage_gravity:0.0,
                                'estimated_price_recalc_at'=> new CDbExpression('NOW()'),
                            );
                        if($estimatedValues['percentage_depreciation_value'] < (isset(Yii::app()->params['percentageDepreciationValueMin'])? Yii::app()->params['percentageDepreciationValueMin'] : -100) 
                            || $estimatedValues['percentage_depreciation_value'] > (isset(Yii::app()->params['percentageDepreciationValueMax'])? Yii::app()->params['percentageDepreciationValueMax'] : 85)) {
                            $updValues['property_status'] = 'Inactive';
                        }
                    PropertyInfo::model()->updateByPk( $id, $updValues );
                }

            }
        
    }

    public function getParams($args) {
        foreach ($args as $value) {
            switch (strtolower($value)) {
                case 'research':
                    $this->research = true;
                    break;
                case 'reset':
                    $this->reset = true;
                    break;
                case 'recalc':
                    $this->recalc = true;
                    break;
                case 'optimal':
                    $this->optimal = true;
                    break;
                case 'byzip':
                    $this->byZip = true;
                    break;
                case 'last30day':
                    $start = time();
                    $this->date30 = date('Y-m-d', $start-30*24*60*60);
                    break;

                default:
                    break;
            }
        }
    }
    
    private function getMode() {
        if(!empty($this->date30)) {
            $date = '(last30day)';
        } else {
            $date = '';
        }

        if($this->recalc) {
            $date .= '(recalc'. (($this->byZip)?' byZip':'') . ')';
        } else {
            $date .= '';
        }

        if(!empty($this->optimal)) {
            $optimal = '(optimal)';
        } else {
            $optimal = '';
        }

        if($this->research) {
            return "ResearchFactors$date$optimal";
        } else {
            return "ReloadFactors$date$optimal";
        }
    }
    private function writeToLog1($content) {
        $filename = Yii::app()->basePath.'/runtime/cronReloadFactors1.log';
        $fp = fopen($filename, 'a');
        if($fp){
            fwrite($fp, $content."\r\n");
        }
        
        fclose($fp); 
    }
    
    private function signPlus($param) {
        if($param >= 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function checkIsBusy(){
        return Yii::app()->redisCache->executeCommand('GET',array($this->busyRedisId));
    }

    
    public function reloadFactorsByZIP() {
        $maxRecalcZip = 4;
        $maxRecalcRec = 1000;

        $select_esimated_time  = Yii::app()->db->createCommand(
                        "SELECT property_zipcode,last_property_id "
                        . "FROM property_info_cron_estimated_price "
                        . "GROUP BY property_zipcode "
                        . "ORDER BY est_id ASC "
                        . "LIMIT 0,{$maxRecalcZip}"
                
        )->queryAll();
foreach ($select_esimated_time as $key => $result_estimated_time) {
    
//print_r($result_estimated_time);
            $estimated_zip_id = $result_estimated_time['property_zipcode'];
            $last_property_id = $result_estimated_time['last_property_id'];

// debug only
//switch ($j) {
//    case 1:
//$estimated_zip_id = 22236;
//$last_property_id = 0;
//break;
//    case 2:
//$estimated_zip_id = 22267;
//$last_property_id = 0;
//break;
//    case 3:
//$estimated_zip_id = 22292;
//$last_property_id = 0;
//}

            $i = 0;
            if ($estimated_zip_id > 0) {
                $ids = Yii::app()->db->createCommand(
"SELECT 
    `property_info`.`property_id`,
    `fundamentals_factor`,
    `conditional_factor`,
    `property_type`,
    `property_zipcode`,
    `compass_point`,
    `house_faces`,
    `house_views`,
    `street_name`,
    `pool`,
    `spa`,
    `stories`,
    `lot_description`,
    `building_description`,
    `carport_type`,
    `converted_garage`,
    `exterior_structure`,
    `roof`,
    `electrical_system`,
    `plumbing_system`,
    `built_desc`,
    `exterior_grounds`,
    `prop_desc`,
    `over_all_property`,
    `foreclosure`,
    `short_sale`,
    `sub_type`,

    `studio`,
    `condo_conversion`,
    `association_features_available`,
    `association_fee_1`,
    `assessment`,
    `sidlid`,
    `parking_description`,
    `fence_type`,
    `court_approval`,
    `bath_downstairs`,
    `bedroom_downstairs`,
    `great_room`,
    `bath_downstairs_description`,
    `flooring_description`,
    `furnishings_description`,
    `heating_features`,
    `possession_description`,
    `financing_considered`,
    `reporeo`,
    `litigation`
FROM
    `property_info`
LEFT JOIN `property_info_details` USING (`property_id` )
LEFT JOIN `property_info_additional_details` USING (`property_id` )
LEFT JOIN `property_info_additional_brokerage_details` USING (`property_id` )
 WHERE property_info.property_zipcode = '{$estimated_zip_id}' "
                                . " AND property_info.property_id > '{$last_property_id}' "
//            . " AND property_info.property_type = 1 "
                                . " AND UPPER(`property_info_additional_brokerage_details`.`status`) NOT IN ('HISTORY','EXPIRED') "
                                . " AND property_info.property_status='Active' "
                                . " ORDER BY `property_id` ASC, property_info.getlatitude DESC "
                                . " LIMIT 0, {$maxRecalcRec}"
                        )->queryAll();
// $this->writeToLog($sql); // `property_info`.`property_id` IN (5562080,5504921,5504927) AND 
                $count_rows = 0;
                $property_id = 0;
                if ($ids !== false) {
                    $count_rows = count($ids);
                    $sum_time = 0;
                    if ($count_rows > 0) {
//                        $this->writeToLog("$cycle: Total " . $count_rows . " rec. ");
                        foreach ($ids as $key => $value) {
                            $property_id = $value['property_id'];
                            $factors = $this->getFactors($value);
                            if (!empty($factors)) {
                                PropertyInfo::model()->updateByPk($value['property_id'], $factors);
                                if ($this->research || $this->recalc) {
                                    $time_start = microtime(TRUE);
                                    $this->recalcEstimatedPrice($value['property_id']);
                                    $time_end = microtime(TRUE);
                                    $time = $time_end - $time_start;
                                    $sum_time += $time;
//$this->writeToLog1("{$value['property_id']} = $time");
                                }
                            }
                        }
                        $this->writeToLog("AVG time=" . ($sum_time / $count_rows));
                    }
                    unset($ids);
$this->writeToLog('zip_id=' . $estimated_zip_id . ' property_id=' . $property_id . ' count=' . $count_rows);
                } else {
                    $this->writeToLog("Error");
                }
                //echo $estimated_zip_id.' == '.$i;
                if ($count_rows >= $maxRecalcRec) {
                    $update_query = Yii::app()->db->createCommand("UPDATE property_info_cron_estimated_price SET last_property_id={$property_id} WHERE property_zipcode = {$estimated_zip_id}" )->query();
                } else {
                    $delete_query = Yii::app()->db->createCommand("DELETE FROM property_info_cron_estimated_price WHERE property_zipcode = {$estimated_zip_id}" )->query();
                }
            } else {
                $delete_query = Yii::app()->db->createCommand("DELETE FROM property_info_cron_estimated_price WHERE property_zipcode = {$estimated_zip_id}")->query();
            }
        }

    }
/*
    public function calculate_estimated_price_part($connect_DB_Object) {

$maxRecalcZip = 4;
$maxRecalcRec = 1000;

$select_esimated_time = $connect_DB_Object->db_query(sprintf(
        "SELECT property_zipcode,last_property_id "
        . "FROM property_info_cron_estimated_price "
//        . "WHERE property_zipcode > 0 "
        . "GROUP BY property_zipcode "
        . "ORDER BY est_id ASC"
        ));
$j=1;
while($j<=$maxRecalcZip && $result_estimated_time = $connect_DB_Object->db_fetch_array($select_esimated_time))
{
//print_r($result_estimated_time);
$estimated_zip_id = $result_estimated_time['property_zipcode'];
$last_property_id = $result_estimated_time['last_property_id'];

// debug only
//switch ($j) {
//    case 1:
//$estimated_zip_id = 22236;
//$last_property_id = 0;
//break;
//    case 2:
//$estimated_zip_id = 22267;
//$last_property_id = 0;
//break;
//    case 3:
//$estimated_zip_id = 22292;
//$last_property_id = 0;
//}

 $i=0;
 if($estimated_zip_id > 0)
{
    $sel_from_property_info= $connect_DB_Object->db_query($sql = sprintf(
            "select property_info.property_id,property_info.garages,property_info.year_biult_id,property_info.pool,property_info.property_type,property_info.lot_acreage,property_info.house_square_footage,property_info.property_price,property_info.bathrooms,property_info.bedrooms,property_info.property_zipcode,property_info.property_city_id,property_info.getlongitude,property_info.getlatitude "
            . " , property_info.subdivision, property_info.fundamentals_factor, property_info.conditional_factor, property_info.sub_type, property_info_details.house_views "
            . " from property_info "
            . " INNER JOIN property_info_additional_brokerage_details ON property_info_additional_brokerage_details.property_id=property_info.property_id "
            . " INNER JOIN property_info_details ON property_info_details.property_id=property_info.property_id "
            . " WHERE property_info.property_zipcode = '{$estimated_zip_id}' "
            . " AND property_info.property_id > '{$last_property_id}' "
//            . " AND property_info.property_type = 1 "
            . " AND UPPER(`property_info_additional_brokerage_details`.`status`) NOT IN ('HISTORY','EXPIRED') "
            . " AND property_info.property_status='Active' "
            . " ORDER BY `property_id` ASC, property_info.getlatitude DESC "
            . " LIMIT 0, {$maxRecalcRec}"
            ));
//actlog($sql);

    $property_id=calculate_estimated_price_cycle($connect_DB_Object, $sel_from_property_info, $startTime, $i);

actlog('zip_id=' . $estimated_zip_id . ' property_id=' . $last_property_id . ' count=' . $i);
     //echo $estimated_zip_id.' == '.$i;
        if($i >= $maxRecalcRec){
            $update_query = $connect_DB_Object->db_query(sprintf("UPDATE property_info_cron_estimated_price SET last_property_id=%d WHERE property_zipcode = %d",$property_id, $estimated_zip_id));
        } else {
            $delete_query = $connect_DB_Object->db_query(sprintf("DELETE FROM property_info_cron_estimated_price WHERE property_zipcode = %d",$estimated_zip_id));
        }
 }
 else
 {
    $delete_query = $connect_DB_Object->db_query($r=sprintf("DELETE FROM property_info_cron_estimated_price WHERE property_zipcode = %d",$estimated_zip_id));
//actlog($r);
 }
}

    setEstimatedPriceFree();

$stopTime = time();
actlog('Stop ' . date('c', $startTime) . ' / '. date('c', $stopTime). ' time=' . ($stopTime-$startTime) );
}
*/
}
