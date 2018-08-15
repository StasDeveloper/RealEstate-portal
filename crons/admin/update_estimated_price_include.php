<?php
include(__DIR__ . "/../include/redis.php");

function calculate_estimated_price_part($connect_DB_Object) {
$startTime = time();
actlog('Start ' . date('c',$startTime ));
//setEstimatedPriceFree();
if($oldStart = isEstimatedPriceBusy()) { actlog('Script already running'); echo 'Another copy of the script executed more : time=' . time_elapsed($startTime-$oldStart), PHP_EOL; return ; }

$gettoday_date=date('Y-m-d');
$max_result="50";  
if(empty($start_record))
{
$start_record="0";
} 
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
    $j++;
}

    setEstimatedPriceFree();

$stopTime = time();
actlog('Stop ' . date('c', $startTime) . ' / '. date('c', $stopTime). ' time=' . ($stopTime-$startTime) );
}

function calculate_estimated_price($connect_DB_Object, $ret_from_property_info, &$actlog) {
        
//        $time = time()-365*24*60*60;
    
        $comp_time1 = time()-200*24*60*60;
        $comp_time = date('Y-m-d', $comp_time1);
        $maxStage = 100;
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
//            $house_views= $ret_from_property_info['house_views'];
            $sub_type= $ret_from_property_info['sub_type'];
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
            $compare_sub_type = '';

            $select_estimated_price_query = $connect_DB_Object->db_query(sprintf("
                SELECT * FROM compare_estimated_price_table WHERE
                    property_type = $property_type AND stage = {$curStage}"
                ));
            $select_estimated_price_result = $connect_DB_Object->db_fetch_array($select_estimated_price_query);
            if(empty($select_estimated_price_result)) {
                // no data in table for $curStage
                $actlog = "No data in compare_estimated_price_table type={$property_type} stage=" . ($curStage-1) ;
                return array(0,0,$curStage-1,0,0,0,1,1);
            }
            $year_compare = $select_estimated_price_result['year_estimated'];
            $lotacre_compare = $select_estimated_price_result['lot_estimated'];
            $house_compare = $select_estimated_price_result['house_estimated'];
            $lot_weighted_compare = $select_estimated_price_result['lot_weighted'];
            $house_weighted_compare = $select_estimated_price_result['house_weighted'];
            $bathrooms_amenties_weighted_compare = $select_estimated_price_result['bathrooms_weighted'];
            $bedrooms_amenties_weighted_compare = $select_estimated_price_result['bedrooms_weighted'];
            $garages_amenties_weighted_compare = $select_estimated_price_result['garages_weighted'];
            $pool_amenties_weighted_compare = $select_estimated_price_result['pool_weighted'];            
            $distance = 0.014428*$select_estimated_price_result['distance'];
            $beds_compare = $select_estimated_price_result['beds_estimated'];
            $baths_compare = $select_estimated_price_result['baths_estimated'];
            $subdivision_compare = $select_estimated_price_result['subdivision_comp'];
            $house_views_compare = $select_estimated_price_result['house_views_comp'];
            $sub_type_compare = $select_estimated_price_result['sub_type_comp'];
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
            }

            if(!empty($sub_type) && !empty($sub_type_compare)){
                $compare_sub_type = "AND property_info.sub_type = '" . addslashes($sub_type) ."'";
//actlog($compare_sub_type);
            }

            if(($compare_lot_sq_footage != '') || ($compare_house_sq_footage != '') || ($compare_property_year_build != '') 
                    || ($compare_property_zipcode != '') || ($compare_property_type != '')
                    || !empty($compare_bedrooms) || !empty($compare_bathrooms) 
                    || !empty($compare_subdivision) || !empty($compare_house_views)
                    || !empty($compare_sub_type)
                ){

                $total_count = countComparePropertyInfo( $connect_DB_Object, $gettoday_date, $comp_time,
                                $compare_property_type,  $compare_property_zipcode, $compare_property_year_build, $compare_lot_sq_footage, $compare_house_sq_footage, $compare_property_lon, $compare_property_lat,
                                $compare_bathrooms, $compare_bedrooms,
                                $compare_subdivision, $compare_house_views,
                                $compare_sub_type, $property_id );
$actlog  .= 'total count'.$comp_stage . '='.$total_count. "($min_compare)\n";
                if($total_count >= $min_compare){
                
                $select_query_estimated_price = $connect_DB_Object->db_query($sql = "SELECT COUNT(property_info.property_id) as count, 
    AVG(`property_info`.`house_square_footage`) AS house_square_footage_average, 
    AVG(`property_info`.`lot_acreage`) AS house_lot_acerage_average, 

    AVG(property_info.property_price/property_info.house_square_footage) AS comps_house_footage_average,
    MAX(property_info.house_square_footage) AS house_footage_max,
    MIN(property_info.house_square_footage) AS house_footage_min,
    AVG(property_info.property_price/property_info.lot_acreage) AS comps_lot_footage_average,
                    STDDEV( IF ( `property_info`.`house_square_footage`, `property_info`.`property_price` / `property_info`.`house_square_footage`, 0 ) ) AS square_footage_stddev, 
                    STDDEV( IF ( `property_info`.`lot_acreage`, `property_info`.`property_price` / `property_info`.`lot_acreage`, 0 ) ) AS lot_footage_stddev,
        AVG(IF (property_info.bathrooms, property_info.property_price/(property_info.bathrooms), 0 )) as bathrooms_amenity_average, 
        STDDEV(IF (property_info.bathrooms, property_info.property_price/(property_info.bathrooms), 0 )) as bathrooms_amenity_stddev, 
        AVG(IF (property_info.bedrooms, property_info.property_price/(property_info.bedrooms), 0 )) as bedrooms_amenity_average, 
        STDDEV(IF (property_info.bedrooms, property_info.property_price/(property_info.bedrooms), 0 )) as bedrooms_amenity_stddev, 
        AVG(IF (property_info.garages, property_info.property_price/(property_info.garages), NULL )) as garages_amenity_average,
        STDDEV(IF (property_info.garages, property_info.property_price/(property_info.garages), NULL )) as garages_amenity_stddev,
        AVG(IF (property_info.pool, property_info.property_price/(property_info.pool), NULL )) as pool_amenity_average,
        STDDEV(IF (property_info.pool, property_info.property_price/(property_info.pool), NULL )) as pool_amenity_stddev
FROM property_info 
INNER JOIN property_info_additional_brokerage_details ON property_info_additional_brokerage_details.property_id=property_info.property_id 
INNER JOIN property_info_details ON property_info_details.property_id=property_info.property_id 
WHERE property_info.property_status='Active' 
    and UPPER(`property_info_additional_brokerage_details`.`status`) NOT IN ('HISTORY','EXPIRED','AUCTION') 
    and property_info.property_expire_date >=DATE('$gettoday_date') AND property_info.property_price > 0 
    and property_info.property_updated_date>=DATE('$comp_time')
        $compare_property_type  $compare_property_zipcode $compare_property_year_build $compare_lot_sq_footage $compare_house_sq_footage $compare_property_lon	$compare_property_lat
        $compare_bathrooms $compare_bedrooms
        $compare_subdivision $compare_house_views
        $compare_sub_type
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
//$actlog  .= 'total count'.$comp_stage . '='.$total_count. "($min_compare)\n";
//                if($total_count >= $min_compare){
                    
                    $house_square_footage_gravity = ((float)$house_sq_footage!=0.0)?sqrt($result_query_estimated_price['house_square_footage_average'] / $house_sq_footage ):0;
                    $lot_footage_gravity = ((float)$lot_sq_footage!=0.0)?sqrt( $result_query_estimated_price['house_lot_acerage_average'] / $lot_sq_footage ):0;

                    $result_query_estimated_price['house_footage_average'] = $result_query_estimated_price['comps_house_footage_average'] * $house_square_footage_gravity;
                    $result_query_estimated_price['lot_footage_average'] = $result_query_estimated_price['comps_lot_footage_average'] * $lot_footage_gravity;

                                 //calculate the true market value  
                    $qualifying_value_square_footage = ((1+$fundamentals_factor)*$result_query_estimated_price['house_footage_average'])+($conditional_factor*($result_query_estimated_price['square_footage_stddev']/(sqrt($total_count))));
                    $qualifying_value_lot_footage = ((1+$fundamentals_factor)*$result_query_estimated_price['lot_footage_average'])+($conditional_factor*($result_query_estimated_price['lot_footage_stddev']/(sqrt($total_count))));
                    $qualifying_value_bathrooms_amenties = ((1+$fundamentals_factor)*$result_query_estimated_price['bathrooms_amenity_average'])+($conditional_factor*($result_query_estimated_price['bathrooms_amenity_stddev']/(sqrt($total_count))));
                    $qualifying_value_bedrooms_amenties = ((1+$fundamentals_factor)*$result_query_estimated_price['bedrooms_amenity_average'])+($conditional_factor*($result_query_estimated_price['bedrooms_amenity_stddev']/(sqrt($total_count))));
                    $qualifying_value_garages_amenties = ((1+$fundamentals_factor)*$result_query_estimated_price['garages_amenity_average'])+($conditional_factor*($result_query_estimated_price['garages_amenity_stddev']/(sqrt($total_count))));
                    $qualifying_value_pool_amenties = ((1+$fundamentals_factor)*$result_query_estimated_price['pool_amenity_average'])+($conditional_factor*($result_query_estimated_price['pool_amenity_stddev']/(sqrt($total_count))));

                    $weighted100 = getSumWeighted(
                        array(
                            'house_weighted' => $select_estimated_price_result['house_weighted'],
                            'lot_weighted' => $select_estimated_price_result['lot_weighted'],
                            'bathrooms_weighted' => $select_estimated_price_result['bathrooms_weighted'],
                            'bedrooms_weighted' => $select_estimated_price_result['bedrooms_weighted'],
                            'garages_weighted' => $select_estimated_price_result['garages_weighted'],
                            'pool_weighted' => $select_estimated_price_result['pool_weighted'],
                        ),
                        $qualifying_value_square_footage, $qualifying_value_lot_footage, $qualifying_value_bathrooms_amenties,
                        $qualifying_value_garages_amenties, $qualifying_value_pool_amenties, $qualifying_value_bedrooms_amenties
                    );

                                     //calculate the low range value  
                    $low_qualifying_value_square_footage = ((1+$fundamentals_factor)*$result_query_estimated_price['house_footage_average'])-($low_sd*($result_query_estimated_price['square_footage_stddev']/(sqrt($total_count))));
                    $low_qualifying_value_lot_footage = ((1+$fundamentals_factor)*$result_query_estimated_price['lot_footage_average'])-($low_sd*($result_query_estimated_price['lot_footage_stddev']/(sqrt($total_count))));
                    $low_qualifying_value_bathrooms_amenties = ((1+$fundamentals_factor)*$result_query_estimated_price['bathrooms_amenity_average'])-($low_sd*($result_query_estimated_price['bathrooms_amenity_stddev']/(sqrt($total_count))));
                    $low_qualifying_value_bedrooms_amenties = ((1+$fundamentals_factor)*$result_query_estimated_price['bedrooms_amenity_average'])-($low_sd*($result_query_estimated_price['bedrooms_amenity_stddev']/(sqrt($total_count))));
                    $low_qualifying_value_garages_amenties = ((1+$fundamentals_factor)*$result_query_estimated_price['garages_amenity_average'])-($low_sd*($result_query_estimated_price['garages_amenity_stddev']/(sqrt($total_count))));
                    $low_qualifying_value_pool_amenties = ((1+$fundamentals_factor)*$result_query_estimated_price['pool_amenity_average'])-($low_sd*($result_query_estimated_price['pool_amenity_stddev']/(sqrt($total_count))));

                    $low_estimated_value_square_footage = $low_qualifying_value_square_footage*$house_sq_footage;
                    $low_estimated_value_lot_footage = $low_qualifying_value_lot_footage*$lot_sq_footage;
                    $low_estimated_value_bathrooms_amenties = $low_qualifying_value_bathrooms_amenties*($bathrooms);
                    $low_estimated_value_bedrooms_amenties = $low_qualifying_value_bedrooms_amenties*($bedrooms);
                    $low_estimated_value_garages_amenties = $low_qualifying_value_garages_amenties*($garages);
                    $low_estimated_value_pool_amenties = $low_qualifying_value_pool_amenties*($pool);

                    $low_weighted_value_square_footage = $low_estimated_value_square_footage*($house_weighted_compare/$weighted100);
                    $low_weighted_value_lot_footage = $low_estimated_value_lot_footage*($lot_weighted_compare/$weighted100);
                    $low_weighted_value_bathrooms_amenties = $low_estimated_value_bathrooms_amenties*($bathrooms_amenties_weighted_compare/$weighted100);
                    $low_weighted_value_bedrooms_amenties = $low_estimated_value_bedrooms_amenties*($bedrooms_amenties_weighted_compare/$weighted100);
                    $low_weighted_value_garages_amenties = $low_estimated_value_garages_amenties*($garages_amenties_weighted_compare/$weighted100);
                    $low_weighted_value_pool_amenties = $low_estimated_value_pool_amenties*($pool_amenties_weighted_compare/$weighted100);

                    $low_range = $low_weighted_value_square_footage+$low_weighted_value_lot_footage+$low_weighted_value_bathrooms_amenties+$low_weighted_value_bedrooms_amenties +$low_weighted_value_garages_amenties +$low_weighted_value_pool_amenties;

                                     //calculate the high range value  
                    $high_qualifying_value_square_footage = ((1+$fundamentals_factor)*$result_query_estimated_price['house_footage_average'])+($high_sd*($result_query_estimated_price['square_footage_stddev']/(sqrt($total_count))));
                    $high_qualifying_value_lot_footage = ((1+$fundamentals_factor)*$result_query_estimated_price['lot_footage_average'])+($high_sd*($result_query_estimated_price['lot_footage_stddev']/(sqrt($total_count))));
                    $high_qualifying_value_bathrooms_amenties = ((1+$fundamentals_factor)*$result_query_estimated_price['bathrooms_amenity_average'])+($high_sd*($result_query_estimated_price['bathrooms_amenity_stddev']/(sqrt($total_count))));
                    $high_qualifying_value_bedrooms_amenties = ((1+$fundamentals_factor)*$result_query_estimated_price['bedrooms_amenity_average'])+($high_sd*($result_query_estimated_price['bedrooms_amenity_stddev']/(sqrt($total_count))));
                    $high_qualifying_value_garages_amenties = ((1+$fundamentals_factor)*$result_query_estimated_price['garages_amenity_average'])+($high_sd*($result_query_estimated_price['garages_amenity_stddev']/(sqrt($total_count))));
                    $high_qualifying_value_pool_amenties = ((1+$fundamentals_factor)*$result_query_estimated_price['pool_amenity_average'])+($high_sd*($result_query_estimated_price['pool_amenity_stddev']/(sqrt($total_count))));

                    $high_estimated_value_square_footage = $high_qualifying_value_square_footage*$house_sq_footage;
                    $high_estimated_value_lot_footage = $high_qualifying_value_lot_footage*$lot_sq_footage;
                    $high_estimated_value_bathrooms_amenties = $high_qualifying_value_bathrooms_amenties*($bathrooms);
                    $high_estimated_value_bedrooms_amenties = $high_qualifying_value_bedrooms_amenties*($bedrooms);
                    $high_estimated_value_garages_amenties = $high_qualifying_value_garages_amenties*($garages);
                    $high_estimated_value_pool_amenties = $high_qualifying_value_pool_amenties*($pool);

                    $high_weighted_value_square_footage = $high_estimated_value_square_footage*($house_weighted_compare/$weighted100);
                    $high_weighted_value_lot_footage = $high_estimated_value_lot_footage*($lot_weighted_compare/$weighted100);
                    $high_weighted_value_bathrooms_amenties = $high_estimated_value_bathrooms_amenties*($bathrooms_amenties_weighted_compare/$weighted100);
                    $high_weighted_value_bedrooms_amenties = $high_estimated_value_bedrooms_amenties*($bedrooms_amenties_weighted_compare/$weighted100);
                    $high_weighted_value_garages_amenties = $high_estimated_value_garages_amenties*($garages_amenties_weighted_compare/$weighted100);
                    $high_weighted_value_pool_amenties = $high_estimated_value_pool_amenties*($pool_amenties_weighted_compare/$weighted100);

                    $high_range = $high_weighted_value_square_footage+$high_weighted_value_lot_footage+$high_weighted_value_bathrooms_amenties+$high_weighted_value_bedrooms_amenties +$high_weighted_value_garages_amenties +$high_weighted_value_pool_amenties;
                
                    if(
                        $house_sq_footage > $result_query_estimated_price['house_footage_max']
                        || $house_sq_footage < $result_query_estimated_price['house_footage_min']
                        || $house_sq_footage > 0 && $qualifying_value_square_footage <= 0 

                        || $lot_sq_footage > 0 && $qualifying_value_lot_footage <= 0 
                        || $bathrooms > 0 && $qualifying_value_bathrooms_amenties <= 0 
                        || $bedrooms > 0 && $qualifying_value_bedrooms_amenties <= 0 
                        || $garages > 0 && $qualifying_value_garages_amenties <= 0 
                        || $pool > 0 && $qualifying_value_pool_amenties <= 0 
                            ) {
//actlog(
//array(
//    array($house_sq_footage , $result_query_estimated_price['house_footage_max']),
//$house_sq_footage > $result_query_estimated_price['house_footage_max']
//    ,array($house_sq_footage , $result_query_estimated_price['house_footage_min'])
//        , $house_sq_footage < $result_query_estimated_price['house_footage_min']
//    ,array($house_sq_footage , $qualifying_value_square_footage)
//, $house_sq_footage > 0 && $qualifying_value_square_footage <= 0 
//    ,array($lot_sq_footage , $qualifying_value_lot_footage)
//, $lot_sq_footage > 0 && $qualifying_value_lot_footage <= 0 
//    ,array($bathrooms , $qualifying_value_bathrooms_amenties)
//, $bathrooms > 0 && $qualifying_value_bathrooms_amenties <= 0 
//    ,array($bedrooms , $qualifying_value_bedrooms_amenties)
//, $bedrooms > 0 && $qualifying_value_bedrooms_amenties <= 0 
//    ,array($garages , $qualifying_value_garages_amenties )
//, $garages > 0 && $qualifying_value_garages_amenties <= 0 
//    ,array($pool , $qualifying_value_pool_amenties)
//, $pool > 0 && $qualifying_value_pool_amenties <= 0 
//)
//        );
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
                            return array(0,0,$curStage-1,0,0,$total_count,1,1);
                        }
                    } else {
//actlog('Non Stop rule');
                        $estimated_value_square_footage = $qualifying_value_square_footage*$house_sq_footage;
                        $estimated_value_lot_footage = $qualifying_value_lot_footage*$lot_sq_footage;
                        $estimated_value_bathrooms_amenties = $qualifying_value_bathrooms_amenties*($bathrooms);
                        $estimated_value_bedrooms_amenties = $qualifying_value_bedrooms_amenties*($bedrooms);
                        $estimated_value_garages_amenties = $qualifying_value_garages_amenties*($garages);
                        $estimated_value_pool_amenties = $qualifying_value_pool_amenties*($pool);

                        $weighted_value_square_footage = $estimated_value_square_footage*($house_weighted_compare/$weighted100);
                        $weighted_value_lot_footage = $estimated_value_lot_footage*($lot_weighted_compare/$weighted100);
                        $weighted_value_bathrooms_amenties = $estimated_value_bathrooms_amenties*($bathrooms_amenties_weighted_compare/$weighted100);
                        $weighted_value_bedrooms_amenties = $estimated_value_bedrooms_amenties*($bedrooms_amenties_weighted_compare/$weighted100);
                        $weighted_value_garages_amenties = $estimated_value_garages_amenties*($garages_amenties_weighted_compare/$weighted100);
                        $weighted_value_pool_amenties = $estimated_value_pool_amenties*($pool_amenties_weighted_compare/$weighted100);

                        $estimated_price = $weighted_value_square_footage+$weighted_value_lot_footage+$weighted_value_bathrooms_amenties +$weighted_value_bedrooms_amenties +$weighted_value_garages_amenties +$weighted_value_pool_amenties;
        //actlog(array($weighted_value_square_footage,$weighted_value_lot_footage, $weighted_value_bathrooms_amenties, $weighted_value_bedrooms_amenties, $weighted_value_garages_amenties, $weighted_value_pool_amenties,$estimated_price));
                        $extract_price = $estimated_price-$property_price;
                        //$percentage_depreciation_value = 0;
                        if(($estimated_price>0)){
                            $percentage_depreciation_value = ($extract_price/$estimated_price)*100;
                        }
                        if($percentage_depreciation_value == '-0'){
                            $percentage_depreciation_value = 0;
                        }

                        return array(
                            $estimated_price,$percentage_depreciation_value,$comp_stage,$low_range,$high_range,$total_count,
                            $house_square_footage_gravity,$lot_footage_gravity
                                );
                    }
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
                        return array(0,0,$curStage-1,0,0,$total_count,1,1);
                    }
                }
            }
}

function calculate_estimated_price_all($connect_DB_Object) {
    
$startTime = time();
actlog('StartAll ' . date('c',$startTime ));
//setEstimatedPriceFree();
if($oldStart = isEstimatedPriceBusy()) { actlog('Script already running'); echo 'Another copy of the script executed more : time=' . time_elapsed($startTime-$oldStart), PHP_EOL; return ; }


 $i=0;
    $sel_from_property_info= $connect_DB_Object->db_query($sql = sprintf(
            "select property_info.property_id,property_info.garages,property_info.year_biult_id,property_info.pool,property_info.property_type,property_info.lot_acreage,property_info.house_square_footage,property_info.property_price,property_info.bathrooms,property_info.bedrooms,property_info.property_zipcode,property_info.property_city_id,property_info.getlongitude,property_info.getlatitude "
            . " , property_info.subdivision, property_info.fundamentals_factor, property_info.conditional_factor, property_info.sub_type, property_info_details.house_views "
            . " from property_info "
//            . " INNER JOIN property_info_additional_brokerage_details ON property_info_additional_brokerage_details.property_id=property_info.property_id "
            . " INNER JOIN property_info_details ON property_info_details.property_id=property_info.property_id "
            . " WHERE 1 "
//            . " AND property_info.property_zipcode = '{$estimated_zip_id}' "
//            . " AND property_info.property_id > '{$last_property_id}' "
//            . " AND UPPER(`property_info_additional_brokerage_details`.`status`) NOT IN ('HISTORY','EXPIRED') "
//            . " AND property_info_additional_brokerage_details.status!='History' AND property_info_additional_brokerage_details.status!='Closed'"
            . " AND property_info.property_status='Active' "
//            . " AND property_info.comp_stage=0 "
            . " ORDER BY `property_id` ASC "
//            . " LIMIT 0, {$maxRecalcRec}"
            ));
//actlog($sql);

    $property_id=calculate_estimated_price_cycle($connect_DB_Object, $sel_from_property_info, $startTime, $i);

    $delete_query = $connect_DB_Object->db_query("TRUNCATE property_info_cron_estimated_price");
    
     setEstimatedPriceFree();

     $stopTime = time();
actlog('StopAll #' . $i .' ' . date('c', $startTime) . ' / '. date('c', $stopTime). ' time=' . time_elapsed($stopTime-$startTime) );

}

function calculate_estimated_price_30($connect_DB_Object) {
$startTime = time();
actlog('Start30 ' . date('c',$startTime ));
//setEstimatedPriceFree();
if($oldStart = isEstimatedPriceBusy()) { actlog('Script already running'); echo 'Another copy of the script executed more : time=' . time_elapsed($startTime-$oldStart), PHP_EOL; return ; }

$date30 = date('Y-m-d', $startTime-30*24*60*60);

 $i=0;
    $sel_from_property_info= $connect_DB_Object->db_query($sql = sprintf(
            "select property_info.property_id,property_info.garages,property_info.year_biult_id,property_info.pool,property_info.property_type,property_info.lot_acreage,property_info.house_square_footage,property_info.property_price,property_info.bathrooms,property_info.bedrooms,property_info.property_zipcode,property_info.property_city_id,property_info.getlongitude,property_info.getlatitude "
            . " , property_info.subdivision, property_info.fundamentals_factor, property_info.conditional_factor, property_info.sub_type, property_info_details.house_views "
            . " from property_info force index (property_updated_date)"
//            . " INNER JOIN property_info_additional_brokerage_details ON property_info_additional_brokerage_details.property_id=property_info.property_id "
            . " INNER JOIN property_info_details ON property_info_details.property_id=property_info.property_id "
            . " WHERE 1 "
//            . " AND property_info.property_zipcode = '{$estimated_zip_id}' "
//            . " AND property_info.property_id > '{$last_property_id}' "
//            . " AND UPPER(`property_info_additional_brokerage_details`.`status`) NOT IN ('HISTORY','EXPIRED') "
//            . " AND property_info_additional_brokerage_details.status!='History' AND property_info_additional_brokerage_details.status!='Closed'"
            . " AND property_info.property_status='Active' "
//            . " AND property_info.comp_stage=0 "
//            . " AND property_info.property_id = '5664796' "
            . " AND property_info.property_updated_date>='{$date30}' "
            . " ORDER BY `property_id` ASC "
//            . " LIMIT 0, {$maxRecalcRec}"
            ));
//actlog($sql);
            
     $property_id=calculate_estimated_price_cycle($connect_DB_Object, $sel_from_property_info, $startTime, $i);
     
     setEstimatedPriceFree();
     
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
        $update_property_info_field_names = array('estimated_price','percentage_depreciation_value','comp_stage','low_range','high_range', 'comps', 'house_square_footage_gravity','lot_footage_gravity');
        $update_property_info_field_datas = calculate_estimated_price($connect_DB_Object, $ret_from_property_info, $actlog);
        $update_property_info_where_condition =" property_id='$property_id' ";
        // set inactive if wrong parameter
        if($update_property_info_field_datas[1] < -100 || $update_property_info_field_datas[1] > 85) {
            $update_property_info_field_names[]='property_status';
            $update_property_info_field_datas[]='Inactive';
actlog('Inactive ' . $update_property_info_where_condition);
        }
////if(!$update_property_info_field_datas[0]) {
//actlog(array(
//    $i,
//    $update_property_info_where_condition,
//    $update_property_info_field_datas,
////    $update_property_info_field_datas_old
//));
////actlog($actlog);
////}
        $update_affected_row = updateDB($update_property_info_field_names,$update_property_info_field_datas,$tablename,$update_property_info_where_condition,$auto_increamentid);
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

function calculate_estimated_price_reset() {
    setEstimatedPriceFree();
$stopTime = time();
actlog('Reset Redis :'. date('c', $stopTime));
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
  $file=fopen(__DIR__ . "/../logs/properties_price.log","a");
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

    function getSumWeighted(
                    $result_query,
                    $house_sq_footage, $lot_sq_footage, $bathrooms, $garages, $pool, $bedrooms
                ) {
            $weighted100 = 0;
            if($house_sq_footage != 0) {
                $weighted100 += $result_query['house_weighted'];
            }
            if($lot_sq_footage != 0) {
                $weighted100 += $result_query['lot_weighted'];
            }
            if($bathrooms != 0) {
                $weighted100 += $result_query['bathrooms_weighted'];
            }
            if($garages != 0) {
                $weighted100 += $result_query['garages_weighted'];
            }
            if($pool != 0) {
                $weighted100 += $result_query['pool_weighted'];
            }
            if($bedrooms != 0) {
                $weighted100 += $result_query['bedrooms_weighted'];
            }

            return $weighted100;
    }
    
    function countComparePropertyInfo(
            $connect_DB_Object, $gettoday_date, $comp_time,
            $compare_property_type,  $compare_property_zipcode, $compare_property_year_build, $compare_lot_sq_footage, $compare_house_sq_footage, $compare_property_lon, $compare_property_lat,
        $compare_bathrooms, $compare_bedrooms,
        $compare_subdivision, $compare_house_views,
        $compare_sub_type, $property_id

            ) {
                $select_query_estimated_price = $connect_DB_Object->db_query($sql = "SELECT COUNT(property_info.property_id) as count_prop
FROM property_info 
INNER JOIN property_info_additional_brokerage_details ON property_info_additional_brokerage_details.property_id=property_info.property_id 
INNER JOIN property_info_details ON property_info_details.property_id=property_info.property_id 
WHERE property_info.property_status='Active' 
    and UPPER(`property_info_additional_brokerage_details`.`status`) NOT IN ('HISTORY','EXPIRED','AUCTION') 
    and property_info.property_expire_date >=DATE('$gettoday_date') AND property_info.property_price > 0 
    and property_info.property_updated_date>=DATE('$comp_time')
        $compare_property_type  $compare_property_zipcode $compare_property_year_build $compare_lot_sq_footage $compare_house_sq_footage $compare_property_lon	$compare_property_lat
        $compare_bathrooms $compare_bedrooms
        $compare_subdivision $compare_house_views
        $compare_sub_type
    AND property_info.property_id != '$property_id'");
                $result_query_estimated_price = $connect_DB_Object->db_fetch_array($select_query_estimated_price);

                $total_count = $result_query_estimated_price['count_prop'];
        return $total_count;
    }
    
    function updateDB($field_names,$field_data,$tablename,$confld)
    {	

            $query="UPDATE $tablename SET estimated_price_recalc_at=NOW(), $field_names[0]=\"$field_data[0]\"";

            for($k=1;$k< count($field_names);$k++)
            {

                    $query.=', '."$field_names[$k]=\"$field_data[$k]\"";

            }
            $query.="  WHERE $confld ";		
            //echo "<br>".$query;	
        if (!($result =  mysql_query($query)))//$query is for the query
            {
                    $mem .= "Error No: ".mysql_errno()."<BR>";
                    $mem .=  "Error details: ".mysql_error();
actlog("$query\n$mem");
            }
            else
            {
            $affrow=mysql_affected_rows();
            return $affrow;	
            }

    }
