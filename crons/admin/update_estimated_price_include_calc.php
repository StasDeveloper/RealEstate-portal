<?php
global $comp_arr;

function calculate_estimated_price_part($connect_DB_Object) {
$startTime = time();
actlog('Start ' . date('c',$startTime ));

$gettoday_date=date('Y-m-d');
$max_result="50";  
if(empty($start_record))
{
$start_record="0";
} 
$maxRecalcZip = 3;
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

//// debug only
//switch ($j) {
//    case 1:
//$estimated_zip_id = 22317;
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
            . " , property_info.subdivision, property_info.fundamentals_factor, property_info.conditional_factor, property_info_details.house_views "
            . " from property_info "
            . " INNER JOIN property_info_additional_brokerage_details ON property_info_additional_brokerage_details.property_id=property_info.property_id "
            . " INNER JOIN property_info_details ON property_info_details.property_id=property_info.property_id "
            . " WHERE property_info.property_zipcode = '{$estimated_zip_id}' "
            . " AND property_info.property_id > '{$last_property_id}' "
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
    $j++;
}
$stopTime = time();
actlog('Stop ' . date('c', $startTime) . ' / '. date('c', $stopTime). ' time=' . ($stopTime-$startTime) );
}

function calculate_estimated_price($connect_DB_Object, $ret_from_property_info, &$actlog) {
        
//        $time = time()-365*24*60*60;
    
        $comp_time1 = time()-200*24*60*60;
        $comp_time = date('Y-m-d', $comp_time1);
        $maxStage = 3;
        $curStage = 1;


        $estPriceValues = calculate_estimated_price_stage(
                    $curStage, $maxStage,
                    $connect_DB_Object,
                    $actlog,
                    $ret_from_property_info,
                    $comp_time

                );
        
//actlog($actlog);          
        return $estPriceValues;
}

function calculate_estimated_price_stage(
                    $curStage, $maxStage,
                    $connect_DB_Object,
                    &$actlog,
                    $ret_from_property_info,
                    $comp_time
        
        ) {
    
        $gettoday_date=date('Y-m-d');

        $percentage_depreciation_value = 0.0;
        $estimated_price = 0;
        $comp_stage = 0;
        $low_range = 0;
        $high_range = 0;

            $property_type = $ret_from_property_info['property_type'];
            $property_id = $ret_from_property_info['property_id'];
            $lot_sq_footage= $ret_from_property_info['lot_acreage'];
            $house_sq_footage= $ret_from_property_info['house_square_footage'];
            $property_price= $ret_from_property_info['property_price'];
            $bathrooms = $ret_from_property_info['bathrooms'];
            $bedrooms = $ret_from_property_info['bedrooms'];
            $select3 = $ret_from_property_info['property_zipcode'];
            $city_id = $ret_from_property_info['property_city_id'];
            $property_lat = $ret_from_property_info['getlatitude'];
            $property_lon = $ret_from_property_info['getlongitude'];

            $garages= $ret_from_property_info['garages'];
            $year_biult_id = $ret_from_property_info['year_biult_id'];
            $pool= $ret_from_property_info['pool'];
            $subdivision= $ret_from_property_info['subdivision'];
            $house_views= $ret_from_property_info['house_views'];
            $house_views_list= $ret_from_property_info['house_views_list'];
            $fundamentals_factor = $ret_from_property_info['fundamentals_factor']; // 0 ;
            $conditional_factor = $ret_from_property_info['conditional_factor']; // 0.1;
        
            $compare_lot_sq_footage='';
            $compare_house_sq_footage='';

            $compare_property_year_build=''; 
            $compare_property_lon='';
            $compare_property_lat='';
            $compare_property_type='';
            $compare_bathrooms = '';
            $compare_bedrooms = '';
            $compare_subdivision = '';
            $compare_house_views = '';

            $select_estimated_price_query = $connect_DB_Object->db_query(sprintf("
                SELECT * FROM compare_estimated_price_table WHERE
                    property_type = $property_type AND stage = {$curStage}"
                ));
            $select_estimated_price_result = $connect_DB_Object->db_fetch_array($select_estimated_price_query);
            if(empty($select_estimated_price_result)) {
                // no data in table for $curStage
                $actlog = "No data in compare_estimated_price_table type={$property_type} stage=" . ($curStage-1) ;
                return array(0,0,$curStage-1,0,0,0);
            }
            $year_compare = $select_estimated_price_result['year_estimated'];
            $lotacre_compare = $select_estimated_price_result['lot_estimated'];
            $house_compare = $select_estimated_price_result['house_estimated'];
            $lot_weighted_compare = $select_estimated_price_result['lot_weighted'];
            $house_weighted_compare = $select_estimated_price_result['house_weighted'];
            $amenties_weighted_compare = $select_estimated_price_result['amenties_weighted'];
            $distance = 0.014428*$select_estimated_price_result['distance'];
            $beds_compare = $select_estimated_price_result['beds_estimated'];
            $baths_compare = $select_estimated_price_result['baths_estimated'];
            $subdivision_compare = $select_estimated_price_result['subdivision_comp'];
            $house_views_compare = $select_estimated_price_result['house_views_comp'];
            $min_compare = $select_estimated_price_result['min_comp'];

            if($property_type != ''){
                $compare_property_type = "AND property_info.property_type = $property_type";
            }

            $compare_property_zipcode = "AND property_info.property_zipcode = $select3";

            if(($property_lat != '0.000000') && ($property_lat != '')){
                $compare_property_lat = "AND property_info.getlatitude BETWEEN " . ($property_lat-$distance) . " AND ". ($property_lat+$distance) ;
            }
            
            if(($property_lon != '0.000000') && ($property_lon != '')){
                $compare_property_lon = "AND property_info.getlongitude BETWEEN " . ($property_lon-$distance) . " AND ". ($property_lon+$distance) ;
            }
            
            if($year_biult_id != ''){
                $compare_property_year_build = "AND property_info.year_biult_id BETWEEN " . ($year_biult_id-$year_compare) . "  AND " . ($year_biult_id+$year_compare) ;
            }

            if(!empty($lot_sq_footage) &&  !empty($lotacre_compare)){
                $percent_lot_footage = $lot_sq_footage*($lotacre_compare/100);
                $compare_lot_sq_footage = "AND property_info.lot_acreage BETWEEN " . ($lot_sq_footage-$percent_lot_footage) . " AND " . ($lot_sq_footage+$percent_lot_footage);
            }
            
            if($house_sq_footage != ''){
                $percent_house_footage = $house_sq_footage*($house_compare/100);
                $compare_house_sq_footage = "AND property_info.house_square_footage BETWEEN " . ($house_sq_footage-$percent_house_footage) . "  AND " . ($house_sq_footage+$percent_house_footage);
            }
            
            if(!empty($baths_compare) &&  !empty($bathrooms)){
                $percent_bathrooms = $bathrooms*($baths_compare/100);
                $compare_bathrooms = "AND property_info.bathrooms BETWEEN " . ($bathrooms-$percent_bathrooms) . "  AND " . ($bathrooms+$percent_bathrooms);
            }

            if(!empty($beds_compare) &&  !empty($bedrooms)){
                $percent_bedrooms = $bedrooms*($beds_compare/100);
                $compare_bedrooms = "AND property_info.bedrooms BETWEEN " . ($bedrooms-$percent_bedrooms) . "  AND " . ($bedrooms+$percent_bedrooms);
            }

            if(!empty($subdivision) && !empty($subdivision_compare)){
                $compare_subdivision = "AND property_info.subdivision = '" . addslashes($subdivision) ."'";
            }

            if(!empty($house_views_list) && !empty($house_views_compare)){
                $compare_house_views_part = '';
                foreach ($house_views_list as $value) {
                    if(!empty($compare_house_views_part)) { $compare_house_views_part .= " AND "; }
                    $compare_house_views_part .= " property_info_details.house_views NOT LIKE '%" . addslashes($value) ."%' ";
                }
                if(!empty($compare_house_views_part)) {
                    $compare_house_views = " AND ( ($compare_house_views_part) OR property_info_details.house_views IS NULL )";
                }
//actlog($compare_house_views);
            }

            if(($compare_lot_sq_footage != '') || ($compare_house_sq_footage != '') || ($compare_property_year_build != '') 
                    || ($compare_property_zipcode != '') || ($compare_property_type != '')
                    || !empty($compare_bedrooms) || !empty($compare_bathrooms) 
                    || !empty($compare_subdivision) || !empty($compare_house_views)
                ){

                $select_query_estimated_price = $connect_DB_Object->db_query($sql = "SELECT COUNT(property_info.property_id) as count, 
    AVG(property_info.property_price/property_info.house_square_footage) AS house_footage_average,
    AVG(property_info.property_price/property_info.lot_acreage) AS lot_footage_average,
    STDDEV(property_info.property_price/property_info.house_square_footage) as square_footage_stddev,
    STDDEV(property_info.property_price/property_info.lot_acreage) as lot_footage_stddev,
    AVG(property_info.property_price/(property_info.bathrooms+property_info.garages+(2*property_info.pool))) as
    amenity_average, STDDEV(property_info.property_price/(property_info.bathrooms+property_info.garages+(2*property_info.pool))) 
    as amenity_stddev FROM property_info 
INNER JOIN property_info_additional_brokerage_details ON property_info_additional_brokerage_details.property_id=property_info.property_id 
INNER JOIN property_info_details ON property_info_details.property_id=property_info.property_id 
WHERE property_info.property_status='Active' 
    and UPPER(`property_info_additional_brokerage_details`.`status`) NOT IN ('HISTORY','EXPIRED','AUCTION') 
    and property_info.property_expire_date >=DATE('$gettoday_date') AND property_info.property_price > 0 
    and property_info.property_updated_date>=DATE('$comp_time')
        $compare_property_type  $compare_property_zipcode $compare_property_year_build $compare_lot_sq_footage $compare_house_sq_footage $compare_property_lon	$compare_property_lat
        $compare_bathrooms $compare_bedrooms
        $compare_subdivision $compare_house_views
    AND property_info.property_id != '$property_id'");
//actlog($sql);
                $result_query_estimated_price = $connect_DB_Object->db_fetch_array($select_query_estimated_price);

                $total_count = $result_query_estimated_price['count'];
                                $df_count = $total_count - 1;
                                $sel_t_score = $connect_DB_Object->db_query("select * from t_table_2_tail where df = '$df_count'");
                                $result_t_score = $connect_DB_Object->db_fetch_array($sel_t_score);
                                
                                //$50_confidence = $result_t_score['tail_50'];
                                //$60_confidence = $result_t_score['tail_60'];
                                //$70_confidence = $result_t_score['tail_70'];
                                //$80_confidence = $result_t_score['tail_80'];
                                //$90_confidence = $result_t_score['tail_90'];
                                //$95_confidence = $result_t_score['tail_95'];
                                //$96_confidence = $result_t_score['tail_96'];
                                //$98_confidence = $result_t_score['tail_98'];
                                //$99_confidence = $result_t_score['tail_99'];
                                //$99_5_confidence = $result_t_score['tail_99_5'];
                                //$99_8_confidence = $result_t_score['tail_99_8'];
                                //$99_9_confidence = $result_t_score['tail_99_9'];
                                //$99_975_confidence = $result_t_score['tail_99_975'];
                                //$99_99_confidence = $result_t_score['tail_99_99'];
                                //$99_995_confidence = $result_t_score['tail_99_995'];
                                
                                $t_score = $result_t_score['tail_90'];
//                                $fundamentals_factor = 0 ;
//                                $conditional_factor = 0.1;
                                $low_sd = $t_score;
                                $high_sd = $t_score;
                                $confidence = 90;
                                $comp_stage = $curStage; 
$actlog  .= 'total count'.$comp_stage . '='.$total_count. "($min_compare)\n";
global $comp_arr;
if(isset($comp_arr[$comp_stage][$total_count])) {
    $comp_arr[$comp_stage][$total_count] += 1;
} else {
    $comp_arr[$comp_stage][$total_count] = 1;
}
                if($total_count >= $min_compare){

                                 //calculate the low range value  
                $low_qualifying_value_square_footage = ((1+$fundamentals_factor)*$result_query_estimated_price['house_footage_average'])-($low_sd*($result_query_estimated_price['square_footage_stddev']/(sqrt($total_count))));
                $low_qualifying_value_lot_footage = ((1+$fundamentals_factor)*$result_query_estimated_price['lot_footage_average'])-($low_sd*($result_query_estimated_price['lot_footage_stddev']/(sqrt($total_count))));
                $low_qualifying_value_amenties = ((1+$fundamentals_factor)*$result_query_estimated_price['amenity_average'])-($low_sd*($result_query_estimated_price['amenity_stddev']/(sqrt($total_count))));

                $low_estimated_value_square_footage = $low_qualifying_value_square_footage*$house_sq_footage;
                $low_estimated_value_lot_footage = $low_qualifying_value_lot_footage*$lot_sq_footage;
                $low_estimated_value_amenties = $low_qualifying_value_amenties*($bathrooms+$garages+(2*$pool));
               
                $low_weighted_value_square_footage = $low_estimated_value_square_footage*($house_weighted_compare/100);
                $low_weighted_value_lot_footage = $low_estimated_value_lot_footage*($lot_weighted_compare/100);
                $low_weighted_value_amenties = $low_estimated_value_amenties*($amenties_weighted_compare/100);

                $low_range = $low_weighted_value_square_footage+$low_weighted_value_lot_footage+$low_weighted_value_amenties;
                
                                 //calculate the high range value  
                $high_qualifying_value_square_footage = ((1+$fundamentals_factor)*$result_query_estimated_price['house_footage_average'])+($high_sd*($result_query_estimated_price['square_footage_stddev']/(sqrt($total_count))));
                $high_qualifying_value_lot_footage = ((1+$fundamentals_factor)*$result_query_estimated_price['lot_footage_average'])+($high_sd*($result_query_estimated_price['lot_footage_stddev']/(sqrt($total_count))));
                $high_qualifying_value_amenties = ((1+$fundamentals_factor)*$result_query_estimated_price['amenity_average'])+($high_sd*($result_query_estimated_price['amenity_stddev']/(sqrt($total_count))));

                $high_estimated_value_square_footage = $high_qualifying_value_square_footage*$house_sq_footage;
                $high_estimated_value_lot_footage = $high_qualifying_value_lot_footage*$lot_sq_footage;
                $high_estimated_value_amenties = $high_qualifying_value_amenties*($bathrooms+$garages+(2*$pool));
               
                $high_weighted_value_square_footage = $high_estimated_value_square_footage*($house_weighted_compare/100);
                $high_weighted_value_lot_footage = $high_estimated_value_lot_footage*($lot_weighted_compare/100);
                $high_weighted_value_amenties = $high_estimated_value_amenties*($amenties_weighted_compare/100);

                $high_range = $high_weighted_value_square_footage+$high_weighted_value_lot_footage+$high_weighted_value_amenties;
                
                                 //calculate the true market value  
                $qualifying_value_square_footage = ((1+$fundamentals_factor)*$result_query_estimated_price['house_footage_average'])+($conditional_factor*($result_query_estimated_price['square_footage_stddev']/(sqrt($total_count))));
                $qualifying_value_lot_footage = ((1+$fundamentals_factor)*$result_query_estimated_price['lot_footage_average'])+($conditional_factor*($result_query_estimated_price['lot_footage_stddev']/(sqrt($total_count))));
                $qualifying_value_amenties = ((1+$fundamentals_factor)*$result_query_estimated_price['amenity_average'])+($conditional_factor*($result_query_estimated_price['amenity_stddev']/(sqrt($total_count))));
               
                $estimated_value_square_footage = $qualifying_value_square_footage*$house_sq_footage;
                $estimated_value_lot_footage = $qualifying_value_lot_footage*$lot_sq_footage;
                $estimated_value_amenties = $qualifying_value_amenties*($bathrooms+$garages+(2*$pool));
               
                $weighted_value_square_footage = $estimated_value_square_footage*($house_weighted_compare/100);
                $weighted_value_lot_footage = $estimated_value_lot_footage*($lot_weighted_compare/100);
                $weighted_value_amenties = $estimated_value_amenties*($amenties_weighted_compare/100);

                $estimated_price = $weighted_value_square_footage+$weighted_value_lot_footage+$weighted_value_amenties;
//actlog(array($weighted_value_square_footage,$weighted_value_lot_footage,$weighted_value_amenties,$estimated_price));
                $extract_price = $estimated_price-$property_price;
                //$percentage_depreciation_value = 0;
                if(($estimated_price>0)){
                    $percentage_depreciation_value = ($extract_price/$estimated_price)*100;
                }
                if($percentage_depreciation_value == '-0'){
                    $percentage_depreciation_value = 0;
                }
                
                return array(
                    $estimated_price,$percentage_depreciation_value,$comp_stage,$low_range,$high_range,$total_count
                        );

                }
                else {
                    $curStage++;
                    if($curStage <= $maxStage) {
                    return calculate_estimated_price_stage(
                    $curStage, $maxStage,
                    $connect_DB_Object,
                    $actlog,
                    $ret_from_property_info,
                    $comp_time

                    );
                    } else {
                        return array(0,0,$curStage-1,0,0,$total_count);
                    }
                }
            }
}

function calculate_estimated_price_all($connect_DB_Object) {
    
$startTime = time();
actlog('StartAll ' . date('c',$startTime ));


 $i=0;
    $sel_from_property_info= $connect_DB_Object->db_query($sql = sprintf(
            "select property_info.property_id,property_info.garages,property_info.year_biult_id,property_info.pool,property_info.property_type,property_info.lot_acreage,property_info.house_square_footage,property_info.property_price,property_info.bathrooms,property_info.bedrooms,property_info.property_zipcode,property_info.property_city_id,property_info.getlongitude,property_info.getlatitude "
            . " , property_info.subdivision, property_info.fundamentals_factor, property_info.conditional_factor, property_info_details.house_views "
            . " from property_info "
//            . " INNER JOIN property_info_additional_brokerage_details ON property_info_additional_brokerage_details.property_id=property_info.property_id "
            . " INNER JOIN property_info_details ON property_info_details.property_id=property_info.property_id "
            . " WHERE 1 "
//            . " AND property_info.property_zipcode = '{$estimated_zip_id}' "
//            . " AND property_info.property_id > '{$last_property_id}' "
//            . " AND UPPER(`property_info_additional_brokerage_details`.`status`) NOT IN ('HISTORY','EXPIRED') "
//            . " AND property_info_additional_brokerage_details.status!='History' AND property_info_additional_brokerage_details.status!='Closed'"
//            . " AND property_info.property_status='Active' "
//            . " AND property_info.comp_stage=0 "
            . " ORDER BY `property_id` ASC "
//            . " LIMIT 0, {$maxRecalcRec}"
            ));
//actlog($sql);

    $property_id=calculate_estimated_price_cycle($connect_DB_Object, $sel_from_property_info, $startTime, $i);

    $delete_query = $connect_DB_Object->db_query("TRUNCATE property_info_cron_estimated_price");
    
$stopTime = time();
actlog('StopAll #' . $i .' ' . date('c', $startTime) . ' / '. date('c', $stopTime). ' time=' . time_elapsed($stopTime-$startTime) );

}

function calculate_estimated_price_30($connect_DB_Object) {
    
$startTime = time();
actlog('Start30 ' . date('c',$startTime ));
$date30 = date('Y-m-d', $startTime-30*24*60*60);

 $i=0;
    $sel_from_property_info= $connect_DB_Object->db_query($sql = sprintf(
            "select property_info.property_id,property_info.garages,property_info.year_biult_id,property_info.pool,property_info.property_type,property_info.lot_acreage,property_info.house_square_footage,property_info.property_price,property_info.bathrooms,property_info.bedrooms,property_info.property_zipcode,property_info.property_city_id,property_info.getlongitude,property_info.getlatitude "
            . " , property_info.subdivision, property_info.fundamentals_factor, property_info.conditional_factor, property_info_details.house_views "
            . " from property_info "
//            . " INNER JOIN property_info_additional_brokerage_details ON property_info_additional_brokerage_details.property_id=property_info.property_id "
            . " INNER JOIN property_info_details ON property_info_details.property_id=property_info.property_id "
            . " WHERE 1 "
//            . " AND property_info.property_zipcode = '{$estimated_zip_id}' "
//            . " AND property_info.property_id > '{$last_property_id}' "
//            . " AND UPPER(`property_info_additional_brokerage_details`.`status`) NOT IN ('HISTORY','EXPIRED') "
//            . " AND property_info_additional_brokerage_details.status!='History' AND property_info_additional_brokerage_details.status!='Closed'"
//            . " AND property_info.property_status='Active' "
//            . " AND property_info.comp_stage=0 "
            . " AND property_info.property_type=1 "
            . " AND property_info.property_updated_date>='{$date30}' "
            . " ORDER BY `property_id` ASC "
//            . " LIMIT 0, {$maxRecalcRec}"
            ));
//actlog($sql);
            
     $property_id=calculate_estimated_price_cycle($connect_DB_Object, $sel_from_property_info, $startTime, $i);
global $comp_arr;

actlog('Total ' . $i);
actlog($comp_arr);
     
$stopTime = time();
actlog('Stop30 #' . $i .' ' . date('c', $startTime) . ' / '. date('c', $stopTime). ' time=' . time_elapsed($stopTime-$startTime) );

}

function calculate_estimated_price_cycle($connect_DB_Object, $sel_from_property_info, $startTime, &$i) {
 $property_id=0;
 
         $house_views_list = get_house_views_list($connect_DB_Object);
//actlog($house_views_list);

    while($ret_from_property_info = $connect_DB_Object->db_fetch_array($sel_from_property_info))
    {
        $i++;
        
        $auto_increamentid="property_id";
        $tablename="property_info";
        $property_id = $ret_from_property_info['property_id'];
        $actlog ='';
        $ret_from_property_info['house_views_list'] = get_house_views_arr($house_views_list, $ret_from_property_info['house_views']);
//actlog($property_id);
//actlog($ret_from_property_info['house_views_list']);
        $update_property_info_field_names = array('estimated_price','percentage_depreciation_value','comp_stage','low_range','high_range', 'comps');
        $update_property_info_field_datas = calculate_estimated_price($connect_DB_Object, $ret_from_property_info, $actlog);
        $update_property_info_where_condition =" property_id='$property_id' ";
////if(!$update_property_info_field_datas[0]) {
//actlog(array(
//    $i,
//    $update_property_info_where_condition,
//    $update_property_info_field_datas,
////    $update_property_info_field_datas_old
//));
////actlog($actlog);
////}
        $update_affected_row = $connect_DB_Object->updateDB($update_property_info_field_names,$update_property_info_field_datas,$tablename,$update_property_info_where_condition,$auto_increamentid);
//        if(!empty($actlog) && !$update_property_info_field_datas[0]) {
//            actlog(' property_id=' . $property_id . ' count=' . $i. ' # '. $actlog);
//        }
        if($i%10000 == 0) {
            $stopTime = time();
            actlog(' property_id=' . $property_id . ' count=' . $i. ' time=' . time_elapsed($stopTime-$startTime));
        }
    }
    return  $property_id;
}

function get_house_views_arr($house_views_list, $house_views) {
    $house_views_ret = array();
    $house_views_lower = strtolower($house_views);
    foreach ($house_views_list as $value) {
        if(strpos($house_views_lower, $value) === false) {
            $house_views_ret[] = $value;
        }
    }
    return $house_views_ret ;
}

function get_house_views_list($connect_DB_Object) {
    $house_views_arr = array();
    if(! $connect_DB_Object) {
        return $house_views_arr;
    }
    $house_views_result = $connect_DB_Object->db_query("
        SELECT house_views FROM market_trend_table WHERE house_views IS NOT NULL AND house_views != '' GROUP BY house_views
            ");
    if(! $house_views_result) {
        $house_views_arr = array();
    }
    while($value = $connect_DB_Object->db_fetch_array($house_views_result)) {
        $house_views_arr[] = strtolower($value['house_views']);
    }
    return $house_views_arr;
}

function actlog($param) {
  $file=fopen(__DIR__ . "/../logs/properties_price_calc.log","a");
  fwrite($file, print_r($param,1));
  fwrite($file, PHP_EOL);
  fclose($file);
}

function actlogAll($param) {
  $file=fopen(__DIR__ . "/../logs/properties_price_all.log","a");
  fwrite($file, print_r($param,1));
  fwrite($file, PHP_EOL);
  fclose($file);
}

function time_elapsed($secs){
    $bit = array(
        'y' => $secs / 31556926 % 12,
        'w' => $secs / 604800 % 52,
        'd' => $secs / 86400 % 7,
        'h' => $secs / 3600 % 24,
        'm' => $secs / 60 % 60,
        's' => $secs % 60
        );
    $ret = array();  
    foreach($bit as $k => $v) {
        if($v > 0){
            $ret[] = $v . $k;
        }
    }
    if(empty($ret)) {
        $ret[] = '0s';
    }
    return join(' ', $ret);
}