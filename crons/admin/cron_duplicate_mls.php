<?php

/**
 *  This script is for deleting duplicate properties from the database .
 */
include(__DIR__ . "/../include/config.php");

ini_set("memory_limit","512M");
$startTime = time();
actlog('Start ' . date('c', $startTime));

$i = 0;

foreach (array(
    'mls'=>"SELECT COUNT( property_id ) AS count, GROUP_CONCAT(property_id ORDER BY property_id ASC ) AS property_id, mls_sysid FROM  `property_info` 
        WHERE mls_sysid !=  ''
        GROUP BY mls_sysid HAVING count >1",
    'property'=>"SELECT COUNT( * ) AS count, GROUP_CONCAT( property_id ORDER BY property_id ASC ) AS property_id, property_type, property_street, property_zipcode, house_square_footage, lot_acreage 
        FROM property_info 
        GROUP BY property_type, property_street, property_zipcode, house_square_footage, lot_acreage  
        HAVING count >1",
    'old_property'=>"SELECT COUNT( * ) AS count, GROUP_CONCAT( property_info.property_id ORDER BY property_info.property_id ASC ) AS property_id, property_type, concat(apt_suite,'-',street_number,'-',street_name,'-',pagent_name) as old_address, property_zipcode, house_square_footage, lot_acreage
        FROM property_info
        left join property_info_details on (property_info.property_id = property_info_details.property_id )
        left join property_info_additional_brokerage_details on (property_info.property_id = property_info_additional_brokerage_details.property_id )
        where street_number is not null and street_name is not null
        GROUP BY property_type, old_address, property_zipcode, house_square_footage, lot_acreage
        HAVING count >1
        ORDER BY `count`  DESC"
    ) as $key=>$query) {
actlog($key);    
    $sql = mysql_query($query)or die(mysql_error());


    $i+= moveToHistory($sql);
}
$stopTime = time();
actlog('Stop #' . $i . ' ' . date('c', $startTime) . ' / ' . date('c', $stopTime) . ' time=' . time_elapsed($stopTime - $startTime));


function moveToHistory($sql) {

$numRows = mysql_num_rows($sql);

$i = 0;

if ($numRows > 0) {
    $ab = array();
    $x = 0;
    $prop_id = array();
    while ($result_query = mysql_fetch_assoc($sql)) {
        $pid = explode(",", $result_query['property_id']);
        $updateID = $pid[count($pid) - 1];
        unset($pid[count($pid) - 1]);
        $propertyID = implode(",", $pid);

        $sql1 = "select * from property_info WHERE property_id IN($propertyID)";
        $query1 = mysql_query($sql1) or die(mysql_error());
        $numRows1 = mysql_num_rows($query1);
        while ($res = mysql_fetch_assoc($query1)) {

            $ab[$i] = '';
            $prop_id[$x] = '';
            $skipFields = array('confidence', 'comp_stage', 'views', 'low_range', 'high_range', 'comps', 'fundamentals_factor', 'conditional_factor', 'house_square_footage_gravity','lot_footage_gravity','estimated_price_recalc_at');
            $ab[$i] .="(";
            $ab[$i] .='"",';
            foreach ($res as $key => $value1) {
                if ($key == 'property_id') {
                    $prop_id[$x] .= $value1 . ',';
                }
                if (!in_array(strtolower($key), $skipFields)) {
                    $ab[$i] .='"' . mysql_real_escape_string($value1) . '",';
                }
            }
            $prop_id[$x] = rtrim($prop_id[$x], ',');
            $ab[$i] = rtrim($ab[$i], ',');

            $ab[$i] .=")";
            $i++;
            $x++;
        }
    }

    if (is_array($ab) && count($ab) > 0) {
        for ($j = 0; $j <= count($ab); $j = $j + 1000) {
            $sql = '';
            $insert = '';
            $multiValue = array();
            $multiPropId = array();
            $x = "";
            for ($k = $j; $k < $j + 1000; $k++) {
                if (isset($prop_id[$k]) && $prop_id[$k] != '') {
                    $multiPropId[] = $prop_id[$k];
                    $multiValue[] = $ab[$k];
                }
            }

            if (is_array($multiPropId) && count($multiPropId) > 0) {
                $finalString = '';
                $finalPropId = '';
                foreach ($multiValue AS $val21) {

                    $finalString.=',' . $val21;
                    continue;
                }
                foreach ($multiPropId as $val1) {
                    $finalPropId .=',' . $val1;
                    continue;
                }
                $finalPropId = ltrim($finalPropId, ',');


                $finalString = ltrim($finalString, ',');

                $errorMysql = false;
                mysql_query("BEGIN");
                actlog($finalPropId);
                $sql = "INSERT INTO `property_info_history` values $finalString";
                $insert = mysql_query($sql); // or die(mysql_error() . ' insert property_info_history error');
//actlog($finalString);
                if (mysql_errno()) {
                    echo mysql_errno() . ": " . mysql_error() . "\n";
                    $errorMysql = true;
                }

                $finalStringDetails = getFinalString($finalPropId, 'property_info_details', array('property_detail_id'));
//actlog($finalStringDetails);
                if (!empty($finalStringDetails)) {
                    $sqlDetails = "INSERT INTO `property_info_details_history` values $finalStringDetails";
                    $insertDetails = mysql_query($sqlDetails); // or die(mysql_error() . ' insert property_info_details_history error');
                    if (mysql_errno()) {
                        echo mysql_errno() . ": " . mysql_error() . "\n";
                        $errorMysql = true;
                    }
                }

                $finalStringAdditionalDetails = getFinalString($finalPropId, 'property_info_additional_details', array('property_additional_detail_id'));
//actlog($finalStringAdditionalDetails);
                if (!empty($finalStringAdditionalDetails)) {
                    $sqlAdditionalDetails = "INSERT INTO `property_info_additional_details_history` values $finalStringAdditionalDetails";
                    $insertAdditionalDetails = mysql_query($sqlAdditionalDetails); // or die(mysql_error() . ' insert property_info_additional_details_history error');
                    if (mysql_errno()) {
                        echo mysql_errno() . ": " . mysql_error() . "\n";
                        $errorMysql = true;
                    }
                }

                $finalStringAdditionalBrokerageDetails = getFinalString($finalPropId, 'property_info_additional_brokerage_details', array('property_info_brokerage_details'));
//actlog($finalStringAdditionalBrokerageDetails);
                if (!empty($finalStringAdditionalBrokerageDetails)) {
                    $sqlAdditionalBrokerageDetails = "INSERT INTO `property_info_additional_brokerage_details_history` values $finalStringAdditionalBrokerageDetails";
                    $insertAdditionalBrokerageDetails = mysql_query($sqlAdditionalBrokerageDetails); // or die(mysql_error() . ' insert property_info_additional_brokerage_details_history error');
                    if (mysql_errno()) {
                        echo mysql_errno() . ": " . mysql_error() . "\n";
                        $errorMysql = true;
                    }
                }

                if (!$errorMysql) {
                    //Delete records from property_info_additional_details table
                    $delete1 = mysql_query("DELETE FROM property_info_additional_details WHERE property_id IN($finalPropId)");
                    if (mysql_errno()) {
                        echo mysql_errno() . ": " . mysql_error() . "\n";
                        $errorMysql = true;
                    }

                    //Delete records from property_info_additional_brokerage_details table
                    $delete2 = mysql_query("DELETE FROM property_info_additional_brokerage_details WHERE property_id IN($finalPropId)");
                    if (mysql_errno()) {
                        echo mysql_errno() . ": " . mysql_error() . "\n";
                        $errorMysql = true;
                    }

                    //Delete records from property_info_details table
                    $delete3 = mysql_query("DELETE FROM property_info_details WHERE property_id IN($finalPropId)");
                    if (mysql_errno()) {
                        echo mysql_errno() . ": " . mysql_error() . "\n";
                        $errorMysql = true;
                    }

                    //Delete records from property_info table
                    $delete4 = mysql_query("DELETE FROM property_info WHERE property_id IN($finalPropId)"); // or die(mysql_error() . 'delete error');
                    if (mysql_errno()) {
                        echo mysql_errno() . ": " . mysql_error() . "\n";
                        $errorMysql = true;
                    }

                    if (!$errorMysql) {
                        mysql_query("COMMIT");
//actlog('COMMIT');
                    } else {
                        mysql_query("ROLLBACK");
                        actlog('ROLLBACK All : ' . mysql_error());
                    }
                } else {
                    mysql_query("ROLLBACK");
                    actlog('ROLLBACK Insert: ' . mysql_error());
                }
            }
        }
    }
}
return $i;
}

function getFinalString($propertyID, $nameTable, $skipFields) {
    $i = 0;
    $ab = array();
    $x = 0;

    $sql1 = "select * from $nameTable WHERE property_id IN($propertyID)";
    $query1 = mysql_query($sql1) or die(mysql_error());
    $numRows1 = mysql_num_rows($query1);
    while ($res = mysql_fetch_assoc($query1)) {

        $ab[$i] = '';
//        $skipFields = array('confidence', 'comp_stage', 'views', 'low_range', 'high_range', 'comps', 'fundamentals_factor', 'conditional_factor');
        $ab[$i] .="(";
        $ab[$i] .='"",';
        foreach ($res as $key => $value1) {
            if (!in_array(strtolower($key), $skipFields)) {
                $ab[$i] .='"' . mysql_real_escape_string($value1) . '",';
//                $ab[$i] .='"' . ($value1) . '",';
            }
        }
        $ab[$i] = rtrim($ab[$i], ',');

        $ab[$i] .=")";
        $i++;
        $x++;
    }
    if (count($ab) > 0) {
        $finalString = '';
        foreach ($ab AS $val21) {

            $finalString.=',' . $val21;
            continue;
        }

        $finalString = ltrim($finalString, ',');

        return $finalString;
    } else {

        return '';
    }
}

function actlog($param) {
    $file = fopen(__DIR__ . "/../logs/cron_duplicate.log", "a");
    fwrite($file, print_r($param, 1));
    fwrite($file, PHP_EOL);
    fclose($file);
}

function time_elapsed($secs) {
    $bit = array(
        'y' => $secs / 31556926 % 12,
        'w' => $secs / 604800 % 52,
        'd' => $secs / 86400 % 7,
        'h' => $secs / 3600 % 24,
        'm' => $secs / 60 % 60,
        's' => $secs % 60
    );
    $ret = array();
    foreach ($bit as $k => $v) {
        if ($v > 0) {
            $ret[] = $v . $k;
        }
    }
    if (empty($ret)) {
        $ret[] = '0s';
    }
    return join(' ', $ret);
}
