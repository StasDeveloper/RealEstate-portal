<?php
/**
 * Deprecated
 */
class CronEstimatedPriceCommand extends CConsoleCommand {

    private $_gettoday_date;
    //public $time = time()-365*24*60*60;
    private $_comp_time;

    //public $comp_time = date('Y-m-d', $comp_time);

    private function actionCompareEstimatedPriceTable($stage, $property_type) {
            $criteria = new CDbCriteria();
            $criteria->alias = 't';
            $criteria->select = '*';
            $criteria->condition = " `t`.`property_type` = :property_type AND `t`.`stage` = :stage ";
            $criteria->params = array(':property_type'=>$property_type, ':stage'=>$stage);
            return CompareEstimatedPriceTable::model()->find($criteria);
    }

    private function actionComparePropertyLat($property_lat, $distance) {
        $miles_distance = 0.014428 * $distance;
        $lat_from = $property_lat - $miles_distance;
        $lat_to = $property_lat + $miles_distance;
        $compare_property_lat_from = " BETWEEN '" . $lat_from . "' ";
        $compare_property_lat_to = " AND '" . $lat_to . "' ";
        return " AND `p`.`getlatitude` {$compare_property_lat_from} {$compare_property_lat_to}";
    }

    private function actionComparePropertyLon($property_lon, $distance) {
        $miles_distance = 0.014428 * $distance;        
        $lon_from = $property_lon + $miles_distance;
        $lon_to = $property_lon - $miles_distance;
        $compare_property_lon_from = " BETWEEN '" . $lon_to . "' ";
        $compare_property_lon_to = " AND '" . $lon_from . "' ";
        return " AND `p`.`getlongitude` {$compare_property_lon_from} {$compare_property_lon_to} ";
    }

    private function actionComparePropertyYearBuild($year_biult_id, $year_compare) {
        $year_build_from = $year_biult_id - $year_compare;
        $year_build_to = $year_biult_id + $year_compare;
        $compare_property_year_build_from = " BETWEEN '" . $year_build_from . "' ";
        $compare_property_year_build_to = " AND '" . $year_build_to . "' ";
        return " AND `p`.`year_biult_id` {$compare_property_year_build_from} {$compare_property_year_build_to}";
    }

    private function actionCompareLotSqFootage($lot_sq_footage, $lotacre_compare) {
        $percent_lot_footage = $lot_sq_footage * ($lotacre_compare / 100);
        $lot_sq_footage_from = $lot_sq_footage - $percent_lot_footage;
        $lot_sq_footage_to = $lot_sq_footage + $percent_lot_footage;
        $compare_lot_sq_footage_from = " BETWEEN '" . $lot_sq_footage_from . "' ";
        $compare_lot_sq_footage_to = " AND '" . $lot_sq_footage_to . "'";
        return " AND `p`.`lot_acreage` {$compare_lot_sq_footage_from} {$compare_lot_sq_footage_to}";
    }

    private function actionCompareHouseSqFootage($house_sq_footage, $house_compare) {
        $percent_house_footage = $house_sq_footage * ($house_compare / 100);
        $house_sq_footage_from = $house_sq_footage - $percent_house_footage;
        $house_sq_footage_to = $house_sq_footage + $percent_house_footage;
        $compare_house_sq_footage_from = " BETWEEN '" . $house_sq_footage_from . "'";
        $compare_house_sq_footage_to = " AND '" . $house_sq_footage_to . "'";
        return " AND `p`.`house_square_footage` {$compare_house_sq_footage_from} {$compare_house_sq_footage_to}";
    }

    private function property_info($property_id, 
                                    $compare_property_type = '', 
                                    $compare_property_zipcode = '', 
                                    $compare_property_year_build = '', 
                                    $compare_lot_sq_footage = '', 
                                    $compare_house_sq_footage = '', 
                                    $compare_property_lon = '', 
                                    $compare_property_lat = '') {
        $gettoday_date = $this->_gettoday_date = date('Y-m-d');
        $comp_time = $this->_comp_time = time() - 200 * 24 * 60 * 60;

        $result_query = Yii::app()->db->createCommand("SELECT COUNT(`p`.`property_id`) as count, 
                        AVG( IF(`p`.`house_square_footage`,`p`.`property_price`/`p`.`house_square_footage`,0) ) AS house_footage_average,
                        AVG( IF(`p`.`lot_acreage`,`p`.`property_price`/`p`.`lot_acreage`,0) ) AS lot_footage_average,
                        STDDEV( IF(`p`.`house_square_footage`,`p`.`property_price`/`p`.`house_square_footage`,0)) as square_footage_stddev,
                        STDDEV( IF(`p`.`lot_acreage`,`p`.`property_price`/`p`.`lot_acreage`,0) ) as lot_footage_stddev,
                        AVG( IF((`p`.`bathrooms`+`p`.`garages`+(2*`p`.`pool`)),`p`.`property_price`/(`p`.`bathrooms`+`p`.`garages`+(2*`p`.`pool`)),0) ) as amenity_average, 
                        STDDEV( IF((`p`.`bathrooms`+`p`.`garages`+(2*`p`.`pool`)),`p`.`property_price`/(`p`.`bathrooms`+`p`.`garages`+(2*`p`.`pool`)),0) ) as amenity_stddev 
                        FROM `property_info` p 
                        INNER JOIN `property_info_additional_brokerage_details` b ON `b`.`property_id`=`p`.`property_id` 
                        WHERE `p`.`property_status`='Active' 
                        AND `b`.`status` != 'History' 
                        AND `p`.`property_expire_date` >= '$gettoday_date' 
                        AND `p`.`property_price` > 0 
                        AND `p`.`property_updated_date` >= '$comp_time' 
                        {$compare_property_type}
                        {$compare_property_zipcode} 
                        {$compare_property_year_build} 
                        {$compare_lot_sq_footage}
                        {$compare_house_sq_footage} 
                        {$compare_property_lon}
                        {$compare_property_lat} AND `p`.`property_id` != '$property_id'")->queryRow();


        return (object) $result_query;
    }

    private function actionGetEstimatedPrice($property_type, 
                                            $property_zipcode, 
                                            $property_lat, 
                                            $property_lon, 
                                            $year_biult_id, 
                                            $lot_sq_footage, 
                                            $house_sq_footage, 
                                            $bathrooms,  
                                            $garages,
                                            $pool, 
                                            $property_id,
                                            $property_price) {
        
        $compare_property_type = '';
                
        if ($property_type) {
            $compare_property_type = " AND `p`.`property_type` = $property_type";

            $select_estimated_price_result = $this->actionCompareEstimatedPriceTable('1', $property_type);
            $select_estimated_price_result2 = $this->actionCompareEstimatedPriceTable('2', $property_type);
            $select_estimated_price_result3 = $this->actionCompareEstimatedPriceTable('3', $property_type); 
            $select_estimated_price_result4 = $this->actionCompareEstimatedPriceTable('4', $property_type); 
            $select_estimated_price_result5 = $this->actionCompareEstimatedPriceTable('5', $property_type); 
        } else {
            return 0;
        }
        
        $compare_property_zipcode = '';
        if ($property_zipcode) {
            $compare_property_zipcode = " AND `p`.`property_zipcode` = {$property_zipcode}";
        }

        $compare_property_lat = '';
        $compare_property_lat2 = '';
        $compare_property_lat3 = '';
        $compare_property_lat4 = '';
        $compare_property_lat5 = '';
        if (($property_lat != '0.000000') && ($property_lat != '')) {
            $compare_property_lat = $select_estimated_price_result ? 
                    $this->actionComparePropertyLat($property_lat, $select_estimated_price_result->distance) : '';
            $compare_property_lat2 = $select_estimated_price_result2 ? 
                    $this->actionComparePropertyLat($property_lat, $select_estimated_price_result2->distance) : '';
            $compare_property_lat3 = $select_estimated_price_result3 ? 
                    $this->actionComparePropertyLat($property_lat, $select_estimated_price_result3->distance) : '';
            $compare_property_lat4 = $select_estimated_price_result4 ? 
                    $this->actionComparePropertyLat($property_lat, $select_estimated_price_result4->distance) : '';
            $compare_property_lat5 = $select_estimated_price_result5 ? 
                    $this->actionComparePropertyLat($property_lat, $select_estimated_price_result5->distance) : '';
        }
        $compare_property_lon = '';
        $compare_property_lon2 = '';
        $compare_property_lon3 = '';
        $compare_property_lon4 = '';
        $compare_property_lon5 = '';
        if (($property_lon != '0.000000') && ($property_lon != '')) {

            $compare_property_lon = $select_estimated_price_result ?
                    $this->actionComparePropertyLon($property_lon, $select_estimated_price_result->distance) : '';
            $compare_property_lon2 = $select_estimated_price_result2 ? 
                    $this->actionComparePropertyLon($property_lon, $select_estimated_price_result2->distance) : '';
            $compare_property_lon3 = $select_estimated_price_result3 ? 
                    $this->actionComparePropertyLon($property_lon, $select_estimated_price_result3->distance) : '';
            $compare_property_lon4 = $select_estimated_price_result4 ? 
                    $this->actionComparePropertyLon($property_lon, $select_estimated_price_result4->distance) : '';
            $compare_property_lon5 = $select_estimated_price_result5 ? 
                    $this->actionComparePropertyLon($property_lon, $select_estimated_price_result5->distance) : '';
        }
        $compare_property_year_build = '';
        $compare_property_year_build2 = '';
        $compare_property_year_build3 = '';
        $compare_property_year_build4 = '';
        $compare_property_year_build5 = '';
        if ($year_biult_id) {

            $compare_property_year_build = $select_estimated_price_result ? 
                    $this->actionComparePropertyYearBuild($year_biult_id, $select_estimated_price_result->year_estimated) : '';
            $compare_property_year_build2 = $select_estimated_price_result2 ? 
                    $this->actionComparePropertyYearBuild($year_biult_id, $select_estimated_price_result2->year_estimated) : '';
            $compare_property_year_build3 = $select_estimated_price_result3 ? 
                    $this->actionComparePropertyYearBuild($year_biult_id, $select_estimated_price_result3->year_estimated) : '';
            $compare_property_year_build4 = $select_estimated_price_result4 ? 
                    $this->actionComparePropertyYearBuild($year_biult_id, $select_estimated_price_result4->year_estimated) : '';
            $compare_property_year_build5 = $select_estimated_price_result5 ? 
                    $this->actionComparePropertyYearBuild($year_biult_id, $select_estimated_price_result5->year_estimated) : '';
        }
        $compare_lot_sq_footage = '';
        $compare_lot_sq_footage2 = '';
        $compare_lot_sq_footage3 = '';
        $compare_lot_sq_footage4 = '';
        $compare_lot_sq_footage5 = '';
        if ($lot_sq_footage) {
            $compare_lot_sq_footage = $select_estimated_price_result ?
                    $this->actionCompareLotSqFootage($lot_sq_footage, $select_estimated_price_result->lot_estimated) : '';
            $compare_lot_sq_footage2 = $select_estimated_price_result2 ? 
                    $this->actionCompareLotSqFootage($lot_sq_footage, $select_estimated_price_result2->lot_estimated) : '';
            $compare_lot_sq_footage3 = $select_estimated_price_result3 ? 
                    $this->actionCompareLotSqFootage($lot_sq_footage, $select_estimated_price_result3->lot_estimated) : '';
            $compare_lot_sq_footage4 = $select_estimated_price_result4 ?
                    $this->actionCompareLotSqFootage($lot_sq_footage, $select_estimated_price_result4->lot_estimated) : '';
            $compare_lot_sq_footage5 = $select_estimated_price_result5 ? 
                    $this->actionCompareLotSqFootage($lot_sq_footage, $select_estimated_price_result5->lot_estimated) : '';
        }
        $compare_house_sq_footage = '';
        $compare_house_sq_footage2 = '';
        $compare_house_sq_footage3 = '';
        $compare_house_sq_footage4 = '';
        $compare_house_sq_footage5 = '';
        if ($house_sq_footage) {
            $compare_house_sq_footage = $select_estimated_price_result ? 
                    $this->actionCompareHouseSqFootage($house_sq_footage, $select_estimated_price_result->house_estimated) : '';
            $compare_house_sq_footage2 = $select_estimated_price_result2 ?
                    $this->actionCompareHouseSqFootage($house_sq_footage, $select_estimated_price_result2->house_estimated) : '';
            $compare_house_sq_footage3 = $select_estimated_price_result3 ? 
                    $this->actionCompareHouseSqFootage($house_sq_footage, $select_estimated_price_result3->house_estimated) : '';
            $compare_house_sq_footage4 = $select_estimated_price_result4 ?
                    $this->actionCompareHouseSqFootage($house_sq_footage, $select_estimated_price_result4->house_estimated) : '';
            $compare_house_sq_footage5 = $select_estimated_price_result5 ?
                    $this->actionCompareHouseSqFootage($house_sq_footage, $select_estimated_price_result5->house_estimated) : '';
        }
        $percentage_depreciation_value = 0;
        $estimated_price = 0;

        if (($compare_lot_sq_footage != '') || 
                ($compare_house_sq_footage != '') || 
                ($compare_property_year_build != '') || 
                ($compare_property_zipcode != '') || 
                ($compare_property_type != '')) {



            $result_query_estimated_price = $this->property_info($property_id,
                                                                $compare_property_type, 
                                                                $compare_property_zipcode, 
                                                                $compare_property_year_build, 
                                                                $compare_lot_sq_footage, 
                                                                $compare_house_sq_footage, 
                                                                $compare_property_lon, 
                                                                $compare_property_lat);
            //print_r($result_query_estimated_price);
            $total_count = $result_query_estimated_price->count;


            if ($total_count >= 8) {

                $qualifying_value_square_footage = $result_query_estimated_price->house_footage_average + (.1 * $result_query_estimated_price->square_footage_stddev);
                $qualifying_value_lot_footage = $result_query_estimated_price->lot_footage_average + (.1 * $result_query_estimated_price->lot_footage_stddev);
                $qualifying_value_amenties = $result_query_estimated_price->amenity_average + (.1 * $result_query_estimated_price->amenity_stddev);

                $estimated_value_square_footage = $qualifying_value_square_footage * $house_sq_footage;
                $estimated_value_lot_footage = $qualifying_value_lot_footage * $lot_sq_footage;
                $estimated_value_amenties = $qualifying_value_amenties * ($bathrooms + $garages + (2 * $pool));

                $weighted_value_square_footage = $select_estimated_price_result ?
                        $estimated_value_square_footage * ($select_estimated_price_result->house_weighted / 100) : 0;
                $weighted_value_lot_footage = $select_estimated_price_result ?
                        $estimated_value_lot_footage * ($select_estimated_price_result->lot_weighted / 100) : 0;
                $weighted_value_amenties = $select_estimated_price_result ?
                        $estimated_value_amenties * ($select_estimated_price_result->amenties_weighted / 100) : 0;

                $estimated_price = $weighted_value_square_footage + $weighted_value_lot_footage + $weighted_value_amenties;
                $extract_price = $estimated_price - $property_price;
                //$percentage_depreciation_value = 0;
                if (($estimated_price > 0)) {
                    $percentage_depreciation_value = round(($extract_price / $estimated_price) * 100);
                }
                if ($percentage_depreciation_value == '-0') {
                    $percentage_depreciation_value = 0;
                }
            } else { /* SECOND START ELSE */

                if (($compare_lot_sq_footage2 != '') || ($compare_house_sq_footage2 != '') || ($compare_property_year_build2 != '') || ($compare_property_zipcode != '') || ($compare_property_type != '')) {

                    $select_query_estimated_price = $this->property_info($property_id, 
                            $compare_property_type, 
                            $compare_property_zipcode, 
                            $compare_property_year_build2, 
                            $compare_lot_sq_footage2, 
                            $compare_house_sq_footage2, 
                            $compare_property_lon2, 
                            $compare_property_lat2);

                    $total_count = $result_query_estimated_price->count;
                    if ($total_count >= 8) {

                        $qualifying_value_square_footage = $result_query_estimated_price->house_footage_average + (.1 * $result_query_estimated_price->square_footage_stddev);
                        $qualifying_value_lot_footage = $result_query_estimated_price->lot_footage_average + (.1 * $result_query_estimated_price->lot_footage_stddev);
                        $qualifying_value_amenties = $result_query_estimated_price->amenity_average + (.1 * $result_query_estimated_price->amenity_stddev);

                        $estimated_value_square_footage = $qualifying_value_square_footage * $house_sq_footage;
                        $estimated_value_lot_footage = $qualifying_value_lot_footage * $lot_sq_footage;
                        $estimated_value_amenties = $qualifying_value_amenties * ($bathrooms + $garages + (2 * $pool));

                        $weighted_value_square_footage = $select_estimated_price_result2 ?
                                $estimated_value_square_footage * ($select_estimated_price_result2->house_weighted / 100) : 0;
                        $weighted_value_lot_footage = $select_estimated_price_result2 ?
                                $estimated_value_lot_footage * ($select_estimated_price_result2->lot_weighted / 100) : 0;
                        $weighted_value_amenties = $select_estimated_price_result2 ? 
                                $estimated_value_amenties * ($select_estimated_price_result2->amenties_weighted / 100) : 0;

                        $estimated_price = $weighted_value_square_footage + $weighted_value_lot_footage + $weighted_value_amenties;
                        $extract_price = $estimated_price - $property_price;
                        //$percentage_depreciation_value = 0;
                        if (($estimated_price > 0)) {
                            $percentage_depreciation_value = round(($extract_price / $estimated_price) * 100);
                        }
                        if ($percentage_depreciation_value == '-0') {
                            $percentage_depreciation_value = 0;
                        }
                    } else { /* THIRD START ELSE */

                        if (($compare_lot_sq_footage3 != '') || ($compare_house_sq_footage3 != '') || ($compare_property_year_build3 != '') || ($compare_property_zipcode != '') || ($compare_property_type != '')) {

                            $select_query_estimated_price = $this->property_info($property_id, $compare_property_type, $compare_property_zipcode, $compare_property_year_build3, $compare_lot_sq_footage3, $compare_house_sq_footage3, $compare_property_lon3, $compare_property_lat3);

                            $total_count = $result_query_estimated_price->count;
                            if ($total_count >= 8) {

                                $qualifying_value_square_footage = $result_query_estimated_price->house_footage_average + (.1 * $result_query_estimated_price->square_footage_stddev);
                                $qualifying_value_lot_footage = $result_query_estimated_price->lot_footage_average + (.1 * $result_query_estimated_price->lot_footage_stddev);
                                $qualifying_value_amenties = $result_query_estimated_price->amenity_average + (.1 * $result_query_estimated_price->amenity_stddev);

                                $estimated_value_square_footage = $qualifying_value_square_footage * $house_sq_footage;
                                $estimated_value_lot_footage = $qualifying_value_lot_footage * $lot_sq_footage;
                                $estimated_value_amenties = $qualifying_value_amenties * ($bathrooms + $garages + (2 * $pool));

                                $weighted_value_square_footage = $select_estimated_price_result3 ?
                                    $estimated_value_square_footage * ($select_estimated_price_result3->house_weighted / 100) : 0;
                                $weighted_value_lot_footage = $select_estimated_price_result3 ?
                                    $estimated_value_lot_footage * ($select_estimated_price_result3->lot_weighted / 100) : 0;
                                $weighted_value_amenties = $select_estimated_price_result3 ?
                                    $estimated_value_amenties * ($select_estimated_price_result3->amenties_weighted / 100) : 0;

                                
                                $estimated_price = $weighted_value_square_footage + $weighted_value_lot_footage + $weighted_value_amenties;
                                $extract_price = $estimated_price - $property_price;
                                //$percentage_depreciation_value = 0;
                                if (($estimated_price > 0)) {
                                    $percentage_depreciation_value = round(($extract_price / $estimated_price) * 100);
                                }
                                if ($percentage_depreciation_value == '-0') {
                                    $percentage_depreciation_value = 0;
                                }
                            } else {
                                if (($compare_lot_sq_footage4 != '') || ($compare_house_sq_footage4 != '') || ($compare_property_year_build4 != '') || ($compare_property_zipcode != '') || ($compare_property_type != '')) {

                                    $select_query_estimated_price = $this->property_info($property_id, $compare_property_type, $compare_property_zipcode, $compare_property_year_build4, $compare_lot_sq_footage4, $compare_house_sq_footage4, $compare_property_lon4, $compare_property_lat4);

                                    $total_count = $result_query_estimated_price->count;
                                    if ($total_count >= 8) {

                                        $qualifying_value_square_footage = $result_query_estimated_price->house_footage_average + (.1 * $result_query_estimated_price->square_footage_stddev);
                                        $qualifying_value_lot_footage = $result_query_estimated_price->lot_footage_average + (.1 * $result_query_estimated_price->lot_footage_stddev);
                                        $qualifying_value_amenties = $result_query_estimated_price->amenity_average + (.1 * $result_query_estimated_price->amenity_stddev);

                                        $estimated_value_square_footage = $qualifying_value_square_footage * $house_sq_footage;
                                        $estimated_value_lot_footage = $qualifying_value_lot_footage * $lot_sq_footage;
                                        $estimated_value_amenties = $qualifying_value_amenties * ($bathrooms + $garages + (2 * $pool));

                                        $weighted_value_square_footage = $select_estimated_price_result4 ?
                                                $estimated_value_square_footage * ($select_estimated_price_result4->house_weighted / 100) : 0;
                                        $weighted_value_lot_footage = $select_estimated_price_result4 ? 
                                                $estimated_value_lot_footage * ($select_estimated_price_result4->lot_weighted / 100) : 0;
                                        $weighted_value_amenties = $select_estimated_price_result4 ?
                                                $estimated_value_amenties * ($select_estimated_price_result4->amenties_weighted / 100) : 0;

                                        $estimated_price = $weighted_value_square_footage + $weighted_value_lot_footage + $weighted_value_amenties;
                                        $extract_price = $estimated_price - $property_price;
                                        //$percentage_depreciation_value = 0;
                                        if (($estimated_price > 0)) {
                                            $percentage_depreciation_value = round(($extract_price / $estimated_price) * 100);
                                        }
                                        if ($percentage_depreciation_value == '-0') {
                                            $percentage_depreciation_value = 0;
                                        }
                                    } else {
                                        if (($compare_lot_sq_footage5 != '') || ($compare_house_sq_footage5 != '') || ($compare_property_year_build5 != '') || ($compare_property_zipcode != '') || ($compare_property_type != '')) {

                                            $select_query_estimated_price = $this->property_info($property_id, $compare_property_type, $compare_property_zipcode, $compare_property_year_build5, $compare_lot_sq_footage5, $compare_house_sq_footage5, $compare_property_lon5, $compare_property_lat5);

                                            $total_count = $result_query_estimated_price->count;
                                            if ($total_count >= 8) {

                                                $qualifying_value_square_footage = $result_query_estimated_price->house_footage_average + (.1 * $result_query_estimated_price->square_footage_stddev);
                                                $qualifying_value_lot_footage = $result_query_estimated_price->lot_footage_average + (.1 * $result_query_estimated_price->lot_footage_stddev);
                                                $qualifying_value_amenties = $result_query_estimated_price->amenity_average + (.1 * $result_query_estimated_price->amenity_stddev);

                                                $estimated_value_square_footage = $qualifying_value_square_footage * $house_sq_footage;
                                                $estimated_value_lot_footage = $qualifying_value_lot_footage * $lot_sq_footage;
                                                $estimated_value_amenties = $qualifying_value_amenties * ($bathrooms + $garages + (2 * $pool));

                                                $weighted_value_square_footage = $select_estimated_price_result5 ?
                                                        $estimated_value_square_footage * ($select_estimated_price_result5->house_weighted / 100) : 0;
                                                $weighted_value_lot_footage = $select_estimated_price_result5 ?
                                                        $estimated_value_lot_footage * ($select_estimated_price_result5->lot_weighted / 100) : 0;
                                                $weighted_value_amenties = $select_estimated_price_result5 ? 
                                                        $estimated_value_amenties * ($select_estimated_price_result5->amenties_weighted / 100) : 0;

                                                $estimated_price = $weighted_value_square_footage + $weighted_value_lot_footage + $weighted_value_amenties;
                                                $extract_price = $estimated_price - $property_price;
                                                //$percentage_depreciation_value = 0;
                                                if (($estimated_price > 0)) {
                                                    $percentage_depreciation_value = round(($extract_price / $estimated_price) * 100);
                                                }
                                                if ($percentage_depreciation_value == '-0') {
                                                    $percentage_depreciation_value = 0;
                                                }
                                            }
                                        }
                                    }
                                }
                            } /* THIRD END ELSE */
                        }
                    } /* SECOND END ELSE */

                }
            }
        }
        return $estimated_price;
    }

    public function actionSetEstimatedPrice() {
        $properties_id_arr = Yii::app()->db->createCommand("SELECT `p`.`property_id` AS property_id, 
                                              `p`.`property_price` AS property_price,
                                              `p`.`property_type` AS property_type, 
                                              `p`.`property_zipcode` AS property_zipcode, 
                                              `p`.`getlatitude` AS property_lat, 
                                              `p`.`getlongitude` AS property_lon, 
                                              `p`.`year_biult_id` AS year_biult_id, 
                                              `p`.`lot_acreage` AS lot_sq_footage, 
                                              `p`.`house_square_footage` AS house_sq_footage, 
                                              `p`.`bathrooms` AS bathrooms,  
                                              `p`.`garages` AS garages,
                                              `p`.`pool` AS pool  
                                      FROM property_info p ")->queryAll();
        $count_rows = count($properties_id_arr);
        
        foreach ($properties_id_arr as $property_row) {
            $property_row = (object)$property_row;
            $estimated_price = $this->actionGetEstimatedPrice($property_row->property_type, 
                                                                $property_row->property_zipcode, 
                                                                $property_row->property_lat, 
                                                                $property_row->property_lon, 
                                                                $property_row->year_biult_id, 
                                                                $property_row->lot_sq_footage, 
                                                                $property_row->house_sq_footage, 
                                                                $property_row->bathrooms,  
                                                                $property_row->garages,
                                                                $property_row->pool, 
                                                                $property_row->property_id,
                                                                $property_row->property_price);
            
            $model = Yii::app()->db->createCommand()->update('property_info', 
                        array('estimated_price'=>$estimated_price), 
                        'property_id=:property_id', 
                        array(':property_id'=>$property_row->property_id));
            
            if($property_row->property_id % 100 === 0){
                echo $property_row->property_id." from ".$count_rows."\r\n";
                
            }
        }
        
                                            
                
    }
}
