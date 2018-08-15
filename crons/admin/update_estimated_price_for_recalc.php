<?php
include(__DIR__ . "/../include/config.php");

$startTime = date('c');
actlog('Start ' . $startTime );

$gettoday_date=date('Y-m-d');
$max_result="50";  
if(empty($start_record))
{
$start_record="0";
} 
$maxRecalcZip = 1000;
$maxRecalcRec = 10000;

$select_esimated_time = $connect_DB_Object->db_query(sprintf(
        "SELECT property_zipcode,last_property_id "
        . "FROM property_info_cron_estimated_price "
        . "WHERE property_zipcode > 0 "
        . "GROUP BY property_zipcode "
        . "ORDER BY est_id DESC"
        ));
$j=1;
while($j<=$maxRecalcZip && $result_estimated_time = $connect_DB_Object->db_fetch_array($select_esimated_time))
{
//print_r($result_estimated_time);
$estimated_zip_id = $result_estimated_time['property_zipcode'];
$last_property_id = $result_estimated_time['last_property_id'];

//$estimated_zip_id = 22267;
//$last_property_id = 0;
 $i=0;
 if($estimated_zip_id > 0)
{
    $sel_from_property_info= $connect_DB_Object->db_query(sprintf(
            "select property_info.property_id,property_info.garages,property_info.year_biult_id,property_info.pool,property_info.property_type,property_info.lot_acreage,property_info.house_square_footage,property_info.property_price,property_info.bathrooms,property_info.property_zipcode,property_info.property_city_id,property_info.getlongitude,property_info.getlatitude "
            . " from property_info "
            . " INNER JOIN property_info_additional_brokerage_details ON property_info_additional_brokerage_details.property_id=property_info.property_id "
            . " WHERE property_info.property_zipcode = '{$estimated_zip_id}' AND property_info.property_id > '{$last_property_id}' AND property_info_additional_brokerage_details.status!='History' AND property_info_additional_brokerage_details.status!='Closed' AND property_info.property_status='Active' "
            . " ORDER BY `property_id` ASC, property_info.getlatitude DESC "
            . " LIMIT 0, {$maxRecalcRec}"
            ));
    
    while($ret_from_property_info = $connect_DB_Object->db_fetch_array($sel_from_property_info))
    {
        $i++;
        ######################################  Start of All Field Name property_info Table #################################
        $property_type = $ret_from_property_info['property_type'];
        $property_id = $ret_from_property_info['property_id'];
        $lot_sq_footage= $ret_from_property_info['lot_acreage'];
        $house_sq_footage= $ret_from_property_info['house_square_footage'];
        $property_price= $ret_from_property_info['property_price'];
        $bathrooms = $ret_from_property_info['bathrooms'];
        $select3 = $ret_from_property_info['property_zipcode'];
        $city_id = $ret_from_property_info['property_city_id'];
        $property_lat = $ret_from_property_info['getlatitude'];
        $property_lon = $ret_from_property_info['getlongitude'];

         $garages= $ret_from_property_info['garages'];
        $year_biult_id = $ret_from_property_info['year_biult_id'];
        $pool= $ret_from_property_info['pool'];
        //print_r($result_property_info_details);

        //echo $num_rows_estimated_price;
$actlog = '';
        include(FULL_MEMBERS_BASE_DIRECTORY."calculate_estimated_price.php");
        //exit();
        $time = time();
        $auto_increamentid="property_id";
        $tablename="property_info";

        $update_property_info_field_names = array('estimated_price','percentage_depreciation_value','comp_stage','low_range','high_range');
        $update_property_info_field_datas = array($estimated_price,$percentage_depreciation_value,$comp_stage,$low_range,$high_range);
        $update_property_info_where_condition =" property_id='$property_id' ";
//if(!$estimated_price) {
//actlog(array(
//    $i,
//    $update_property_info_where_condition,
//    $update_property_info_field_datas
//));
//actlog($actlog);
//}
        $update_affected_row = $connect_DB_Object->updateDB($update_property_info_field_names,$update_property_info_field_datas,$tablename,$update_property_info_where_condition,$auto_increamentid);

    }
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
     ?>
     <tr>
        <td colspan="3" align="center" style="height: 40px; font-family: arial; font-size: 17px; color:#666666;"><i>There is no pending zipcode to calculate estimated price .</i></td>
    </tr>
     <?php
 }
    $j++;
}
actlog('Stop ' . $startTime . ' / '. date('c') );

function actlog($param) {
  $file=fopen(__DIR__ . "/../logs/properties_log_price_recalc.txt","a");
  fwrite($file, print_r($param,1));
  fwrite($file, PHP_EOL);
  fclose($file);
}