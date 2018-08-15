<?php

class CronMarketInfoCommand extends CConsoleCommand {
    
        
    public function run() {
        $content = "\r\n\r\n Start at ". date('Y-m-d H:i:s')."\r\n";    
        $content .= $this->countSameSubdivision();
        $content .= $this->countSameArea();
        $content .= $this->countSameZipCode();
        $content .= $this->countSameCity();
        $content .= $this->countSameCounty();
        $content .= $this->countSameState();
        $content .= 'Finished at '. date('Y-m-d H:i:s')."\r\n";
        $this->writeToLog($content);
    }
    
    private function writeToLog($content) {
        $filename = Yii::app()->basePath.'/runtime/cronlog.txt';
        $fp = fopen($filename, 'a');
        if($fp){
            fwrite($fp, $content);
        }
        
        fclose($fp); 
    }
    
    private function countSameSubdivision(){
        $start = time();
        if ( Yii::app()->db->createCommand("INSERT INTO `tbl_cron_market_info_subdivision`(
                                                    `id`,
                                                    `subdivision`, 
                                                    `date`, 
                                                    `total`, 
                                                    `sale`, 
                                                    `sold`, 
                                                    `foreclosure`, 
                                                    `short_sales`, 
                                                    `avg_price`, 
                                                    `high_ppsf`, 
                                                    `low_ppsf`, 
                                                    `avg_ppsf`) 
                                                    SELECT null, `tbl_p`.`subdivision`, now(),

                                                        (SELECT count(`tp1`.`subdivision`) 
                                                            FROM `property_info` tp1 
                                                            WHERE `tp1`.`subdivision` = `tbl_p`.`subdivision`),

                                                        (SELECT count(`tb1`.`status`)
                                                            FROM `property_info_additional_brokerage_details` tb1 
                                                            LEFT JOIN `property_info` tp2  
                                                            ON `tp2`.`property_id`=`tb1`.`property_id` 
                                                            WHERE `tp2`.`subdivision` = `tbl_p`.`subdivision`
                                                            AND UPPER(`tb1`.`status`)='FOR SALE'), 

                                                        (SELECT count(`tb2`.`status`) 
                                                            FROM `property_info_additional_brokerage_details` tb2 
                                                            LEFT JOIN `property_info` tp3  
                                                            ON `tp3`.`property_id`=`tb2`.`property_id` 
                                                            WHERE `tp3`.`subdivision` = `tbl_p`.`subdivision`
                                                            AND UPPER(`tb2`.`status`)='SOLD'),

                                                        (SELECT count(`tb3`.`status`) as count3
                                                            FROM `property_info_additional_brokerage_details` tb3 
                                                            LEFT JOIN `property_info` tp4  
                                                            ON `tp4`.`property_id`=`tb3`.`property_id` 
                                                            WHERE `tp4`.`subdivision` = `tbl_p`.`subdivision`
                                                            AND UPPER(`tb3`.`status`)='FORECLOSURE'),

                                                        (SELECT count(`tb4`.`status`)
                                                            FROM `property_info_additional_brokerage_details` tb4
                                                            LEFT JOIN `property_info` tp5  
                                                            ON `tp5`.`property_id`=`tb4`.`property_id` 
                                                            WHERE `tp5`.`subdivision` = `tbl_p`.`subdivision`
                                                            AND UPPER(`tb4`.`status`)='SHORT_SALES'),

                                                        (SELECT AVG(`tp6`.`property_price`) 
                                                            FROM `property_info` tp6 
                                                            WHERE `tp6`.`subdivision` = `tbl_p`.`subdivision`),

                                                        (SELECT MAX(IF(`tp7`.`house_square_footage`,`tp7`.`property_price` / `tp7`.`house_square_footage`, 0))  
                                                            FROM `property_info` tp7 
                                                            WHERE `tp7`.`subdivision` = `tbl_p`.`subdivision`),
                                                            

                                                        (SELECT MIN(IF(`tp8`.`house_square_footage`,`tp8`.`property_price` / `tp8`.`house_square_footage`,0))  
                                                            FROM `property_info` tp8 
                                                            WHERE `tp8`.`subdivision` = `tbl_p`.`subdivision`),

                                                        (SELECT AVG(IF(`tp9`.`house_square_footage`,`tp9`.`property_price` / `tp9`.`house_square_footage`,0))  
                                                            FROM `property_info` tp9 
                                                            WHERE `tp9`.`subdivision` = `tbl_p`.`subdivision`)
                                                    FROM `property_info` tbl_p 
                                                    WHERE  `tbl_p`.`subdivision` !=  ''
                                                    GROUP BY `tbl_p`.subdivision
                                                ")->execute()){
                   $end = time();
                   $query_took = $end-$start;
                   
                   return "tbl_cron_market_info_subdivision is done! \r\n Query took ".$query_took." sec. \r\n";
               } else {
                   return "Error tbl_cron_market_info_subdivision \r\n";
               }
    }
    
    private function countSameArea(){
        $start = time();
        if ( Yii::app()->db->createCommand("INSERT INTO `tbl_cron_market_info_area`(
                                                    `id`,
                                                    `area`, 
                                                    `date`, 
                                                    `total`, 
                                                    `sale`, 
                                                    `sold`, 
                                                    `foreclosure`, 
                                                    `short_sales`, 
                                                    `avg_price`, 
                                                    `high_ppsf`, 
                                                    `low_ppsf`, 
                                                    `avg_ppsf`) 
                                                    SELECT null, `tbl_p`.`area`, now(),

                                                        (SELECT count(`tp1`.`area`) 
                                                            FROM `property_info` tp1 
                                                            WHERE `tp1`.`area` = `tbl_p`.`area`),

                                                        (SELECT count(`tb1`.`status`)
                                                            FROM `property_info_additional_brokerage_details` tb1 
                                                            LEFT JOIN `property_info` tp2  
                                                            ON `tp2`.`property_id`=`tb1`.`property_id` 
                                                            WHERE `tp2`.`area` = `tbl_p`.`area`
                                                            AND UPPER(`tb1`.`status`)='FOR SALE'), 

                                                        (SELECT count(`tb2`.`status`) 
                                                            FROM `property_info_additional_brokerage_details` tb2 
                                                            LEFT JOIN `property_info` tp3  
                                                            ON `tp3`.`property_id`=`tb2`.`property_id` 
                                                            WHERE `tp3`.`area` = `tbl_p`.`area`
                                                            AND UPPER(`tb2`.`status`)='SOLD'),

                                                        (SELECT count(`tb3`.`status`) as count3
                                                            FROM `property_info_additional_brokerage_details` tb3 
                                                            LEFT JOIN `property_info` tp4  
                                                            ON `tp4`.`property_id`=`tb3`.`property_id` 
                                                            WHERE `tp4`.`area` = `tbl_p`.`area`
                                                            AND UPPER(`tb3`.`status`)='FORECLOSURE'),

                                                        (SELECT count(`tb4`.`status`)
                                                            FROM `property_info_additional_brokerage_details` tb4
                                                            LEFT JOIN `property_info` tp5  
                                                            ON `tp5`.`property_id`=`tb4`.`property_id` 
                                                            WHERE `tp5`.`area` = `tbl_p`.`area`
                                                            AND UPPER(`tb4`.`status`)='SHORT_SALES'),

                                                        (SELECT AVG(`tp6`.`property_price`) 
                                                            FROM `property_info` tp6 
                                                            WHERE `tp6`.`area` = `tbl_p`.`area`),

                                                        (SELECT MAX(IF(`tp7`.`house_square_footage`,`tp7`.`property_price` / `tp7`.`house_square_footage`, 0))  
                                                            FROM `property_info` tp7 
                                                            WHERE `tp7`.`area` = `tbl_p`.`area`),
                                                            

                                                        (SELECT MIN(IF(`tp8`.`house_square_footage`,`tp8`.`property_price` / `tp8`.`house_square_footage`,0))  
                                                            FROM `property_info` tp8 
                                                            WHERE `tp8`.`area` = `tbl_p`.`area`),

                                                        (SELECT AVG(IF(`tp9`.`house_square_footage`,`tp9`.`property_price` / `tp9`.`house_square_footage`,0))  
                                                            FROM `property_info` tp9 
                                                            WHERE `tp9`.`area` = `tbl_p`.`area`)
                                                    FROM `property_info` tbl_p 
                                                    WHERE  `tbl_p`.`area` !=  ''
                                                    GROUP BY `tbl_p`.area
                                                ")->execute()){
                   $end = time();
                   $query_took = $end-$start;
                   return "tbl_cron_market_info_area is done! \r\n Query took ".$query_took." sec. \r\n";
               } else {
                   return "Error tbl_cron_market_info_area \r\n";
               }
    }
        
    private function countSameZipCode(){
        $start = time();
        if(Yii::app()->db->createCommand(
                "INSERT INTO `tbl_cron_market_info_zipcode`(
                        `id`,
                        `zipcode_id`, 
                        `date`, 
                        `total`, 
                        `sale`, 
                        `sold`, 
                        `foreclosure`, 
                        `short_sales`, 
                        `avg_price`, 
                        `high_ppsf`, 
                        `low_ppsf`, 
                        `avg_ppsf`
                    )
                    SELECT null, `tbl_p`.`property_zipcode`, NOW() , 
                        (SELECT count(`tp1`.`property_zipcode`) 
                            FROM `property_info` tp1 
                            WHERE `tp1`.`property_zipcode` = `tbl_p`.`property_zipcode`),
                            
                        (SELECT count(`tb1`.`status`)
                            FROM `property_info_additional_brokerage_details` tb1 
                            LEFT JOIN `property_info` tp2  
                            ON `tp2`.`property_id`=`tb1`.`property_id` 
                            WHERE `tp2`.`property_zipcode` = `tbl_p`.`property_zipcode`
                            AND UPPER(`tb1`.`status`)='FOR SALE'), 

                        (SELECT count(`tb2`.`status`) 
                            FROM `property_info_additional_brokerage_details` tb2 
                            LEFT JOIN `property_info` tp3  
                            ON `tp3`.`property_id`=`tb2`.`property_id` 
                            WHERE `tp3`.`property_zipcode` = `tbl_p`.`property_zipcode`
                            AND UPPER(`tb2`.`status`)='SOLD'),

                        (SELECT count(`tb3`.`status`) as count3
                            FROM `property_info_additional_brokerage_details` tb3 
                            LEFT JOIN `property_info` tp4  
                            ON `tp4`.`property_id`=`tb3`.`property_id` 
                            WHERE `tp4`.`property_zipcode` = `tbl_p`.`property_zipcode`
                            AND UPPER(`tb3`.`status`)='FORECLOSURE'),

                        (SELECT count(`tb4`.`status`)
                            FROM `property_info_additional_brokerage_details` tb4
                            LEFT JOIN `property_info` tp5  
                            ON `tp5`.`property_id`=`tb4`.`property_id` 
                            WHERE `tp5`.`property_zipcode` = `tbl_p`.`property_zipcode`
                            AND UPPER(`tb4`.`status`)='SHORT_SALES'),

                        (SELECT AVG(`tp6`.`property_price`) 
                            FROM `property_info` tp6 
                            WHERE `tp6`.`property_zipcode` = `tbl_p`.`property_zipcode`),

                        (SELECT MAX(IF(`tp7`.`house_square_footage`,`tp7`.`property_price` / `tp7`.`house_square_footage`,0))  
                            FROM `property_info` tp7 
                            WHERE `tp7`.`property_zipcode` = `tbl_p`.`property_zipcode`),

                        (SELECT MIN(IF(`tp8`.`house_square_footage`,`tp8`.`property_price` / `tp8`.`house_square_footage`,0))  
                            FROM `property_info` tp8 
                            WHERE `tp8`.`property_zipcode` = `tbl_p`.`property_zipcode`),

                        (SELECT AVG(IF(`tp9`.`house_square_footage`,`tp9`.`property_price` / `tp9`.`house_square_footage`,0))  
                            FROM `property_info` tp9 
                            WHERE `tp9`.`property_zipcode` = `tbl_p`.`property_zipcode`)
                    FROM  `property_info` tbl_p 
                    WHERE  `tbl_p`.`property_zipcode` !=  ''
                    GROUP BY `tbl_p`.property_zipcode
                    
                "
                )->execute()){
            $end = time();
            $query_took = $end-$start;
            return "tbl_cron_market_info_zipcode is done! \r\n Query took ".$query_took." sec. \r\n";
        } else {
             return "Error tbl_cron_market_info_zipcode \r\n";
        }
    }
    
    private function countSameCity(){
        $start = time();
        if(Yii::app()->db->createCommand(
                "INSERT INTO `tbl_cron_market_info_city`(
                        `id`, 
                        `city_id`, 
                        `date`, 
                        `total`, 
                        `sale`, 
                        `sold`, 
                        `foreclosure`, 
                        `short_sales`, 
                        `avg_price`, 
                        `high_ppsf`, 
                        `low_ppsf`, 
                        `avg_ppsf`
                    )
                    SELECT null, `tbl_p`.`property_city_id`, NOW() , 
                        (SELECT count(`tp1`.`property_city_id`) 
                            FROM `property_info` tp1 
                            WHERE `tp1`.`property_city_id` = `tbl_p`.`property_city_id`),
                            
                        (SELECT count(`tb1`.`status`)
                            FROM `property_info_additional_brokerage_details` tb1 
                            LEFT JOIN `property_info` tp2  
                            ON `tp2`.`property_id`=`tb1`.`property_id` 
                            WHERE `tp2`.`property_city_id` = `tbl_p`.`property_city_id`
                            AND UPPER(`tb1`.`status`)='FOR SALE'), 

                        (SELECT count(`tb2`.`status`) 
                            FROM `property_info_additional_brokerage_details` tb2 
                            LEFT JOIN `property_info` tp3  
                            ON `tp3`.`property_id`=`tb2`.`property_id` 
                            WHERE `tp3`.`property_city_id` = `tbl_p`.`property_city_id`
                            AND UPPER(`tb2`.`status`)='SOLD'),

                        (SELECT count(`tb3`.`status`) as count3
                            FROM `property_info_additional_brokerage_details` tb3 
                            LEFT JOIN `property_info` tp4  
                            ON `tp4`.`property_id`=`tb3`.`property_id` 
                            WHERE `tp4`.`property_city_id` = `tbl_p`.`property_city_id`
                            AND UPPER(`tb3`.`status`)='FORECLOSURE'),

                        (SELECT count(`tb4`.`status`)
                            FROM `property_info_additional_brokerage_details` tb4
                            LEFT JOIN `property_info` tp5  
                            ON `tp5`.`property_id`=`tb4`.`property_id` 
                            WHERE `tp5`.`property_city_id` = `tbl_p`.`property_city_id`
                            AND UPPER(`tb4`.`status`)='SHORT_SALES'),

                        (SELECT AVG(`tp6`.`property_price`) 
                            FROM `property_info` tp6 
                            WHERE `tp6`.`property_city_id` = `tbl_p`.`property_city_id`),

                        (SELECT MAX(IF(`tp7`.`house_square_footage`,`tp7`.`property_price` / `tp7`.`house_square_footage`,0))  
                            FROM `property_info` tp7 
                            WHERE `tp7`.`property_city_id` = `tbl_p`.`property_city_id`),

                        (SELECT MIN(IF(`tp8`.`house_square_footage`,`tp8`.`property_price` / `tp8`.`house_square_footage`,0))  
                            FROM `property_info` tp8 
                            WHERE `tp8`.`property_city_id` = `tbl_p`.`property_city_id`),

                        (SELECT AVG(IF(`tp9`.`house_square_footage`,`tp9`.`property_price` / `tp9`.`house_square_footage`,0))  
                            FROM `property_info` tp9 
                            WHERE `tp9`.`property_city_id` = `tbl_p`.`property_city_id`)
                    FROM  `property_info` tbl_p 
                    WHERE  `tbl_p`.`property_city_id` !=  ''
                    GROUP BY `tbl_p`.property_city_id
                    
                "
                )->execute()){
            $end = time();
            $query_took = $end-$start;
            return "tbl_cron_market_info_city is done! \r\n Query took ".$query_took." sec. \r\n";
        } else {
             return "Error tbl_cron_market_info_city \r\n";
        }
    }
    
    private function countSameCounty(){
         $start = time();
        if(Yii::app()->db->createCommand(
                "INSERT INTO `tbl_cron_market_info_county`(
                        `id`, 
                        `county_id`, 
                        `date`, 
                        `total`, 
                        `sale`, 
                        `sold`, 
                        `foreclosure`, 
                        `short_sales`, 
                        `avg_price`, 
                        `high_ppsf`, 
                        `low_ppsf`, 
                        `avg_ppsf`
                    )
                    SELECT null, `tbl_p`.`property_county_id`, NOW() , 
                        (SELECT count(`tp1`.`property_county_id`) 
                            FROM `property_info` tp1 
                            WHERE `tp1`.`property_county_id` = `tbl_p`.`property_county_id`),
                            
                        (SELECT count(`tb1`.`status`)
                            FROM `property_info_additional_brokerage_details` tb1 
                            LEFT JOIN `property_info` tp2  
                            ON `tp2`.`property_id`=`tb1`.`property_id` 
                            WHERE `tp2`.`property_county_id` = `tbl_p`.`property_county_id`
                            AND UPPER(`tb1`.`status`)='FOR SALE'), 

                        (SELECT count(`tb2`.`status`) 
                            FROM `property_info_additional_brokerage_details` tb2 
                            LEFT JOIN `property_info` tp3  
                            ON `tp3`.`property_id`=`tb2`.`property_id` 
                            WHERE `tp3`.`property_county_id` = `tbl_p`.`property_county_id`
                            AND UPPER(`tb2`.`status`)='SOLD'),

                        (SELECT count(`tb3`.`status`) as count3
                            FROM `property_info_additional_brokerage_details` tb3 
                            LEFT JOIN `property_info` tp4  
                            ON `tp4`.`property_id`=`tb3`.`property_id` 
                            WHERE `tp4`.`property_county_id` = `tbl_p`.`property_county_id`
                            AND UPPER(`tb3`.`status`)='FORECLOSURE'),

                        (SELECT count(`tb4`.`status`)
                            FROM `property_info_additional_brokerage_details` tb4
                            LEFT JOIN `property_info` tp5  
                            ON `tp5`.`property_id`=`tb4`.`property_id` 
                            WHERE `tp5`.`property_county_id` = `tbl_p`.`property_county_id`
                            AND UPPER(`tb4`.`status`)='SHORT_SALES'),

                        (SELECT AVG(`tp6`.`property_price`) 
                            FROM `property_info` tp6 
                            WHERE `tp6`.`property_county_id` = `tbl_p`.`property_county_id`),

                        (SELECT MAX(IF(`tp7`.`house_square_footage`,`tp7`.`property_price` / `tp7`.`house_square_footage`,0))  
                            FROM `property_info` tp7 
                            WHERE `tp7`.`property_county_id` = `tbl_p`.`property_county_id`),

                        (SELECT MIN(IF(`tp8`.`house_square_footage`,`tp8`.`property_price` / `tp8`.`house_square_footage`,0))  
                            FROM `property_info` tp8 
                            WHERE `tp8`.`property_county_id` = `tbl_p`.`property_county_id`),

                        (SELECT AVG(IF(`tp9`.`house_square_footage`,`tp9`.`property_price` / `tp9`.`house_square_footage`,0))  
                            FROM `property_info` tp9 
                            WHERE `tp9`.`property_county_id` = `tbl_p`.`property_county_id`)
                    FROM  `property_info` tbl_p 
                    WHERE  `tbl_p`.`property_county_id` !=  ''
                    GROUP BY `tbl_p`.property_county_id
                    
                "
                )->execute()){
             $end = time();
            $query_took = $end-$start;
            return "tbl_cron_market_info_county is done! \r\n Query took ".$query_took." sec. \r\n";
        } else {
             return "Error tbl_cron_market_info_county \r\n";
        }
    }
    
    private function countSameState(){
         $start = time();
        if(Yii::app()->db->createCommand(
                "INSERT INTO `tbl_cron_market_info_state`(
                        `id`,
                        `state_id`, 
                        `date`, 
                        `total`, 
                        `sale`, 
                        `sold`, 
                        `foreclosure`, 
                        `short_sales`, 
                        `avg_price`, 
                        `high_ppsf`, 
                        `low_ppsf`, 
                        `avg_ppsf`
                    )
                    SELECT null, `tbl_p`.`property_state_id`, NOW() , 
                        (SELECT count(`tp1`.`property_state_id`) 
                            FROM `property_info` tp1 
                            WHERE `tp1`.`property_state_id` = `tbl_p`.`property_state_id`),
                            
                        (SELECT count(`tb1`.`status`)
                            FROM `property_info_additional_brokerage_details` tb1 
                            LEFT JOIN `property_info` tp2  
                            ON `tp2`.`property_id`=`tb1`.`property_id` 
                            WHERE `tp2`.`property_state_id` = `tbl_p`.`property_state_id`
                            AND UPPER(`tb1`.`status`)='FOR SALE'), 

                        (SELECT count(`tb2`.`status`) 
                            FROM `property_info_additional_brokerage_details` tb2 
                            LEFT JOIN `property_info` tp3  
                            ON `tp3`.`property_id`=`tb2`.`property_id` 
                            WHERE `tp3`.`property_state_id` = `tbl_p`.`property_state_id`
                            AND UPPER(`tb2`.`status`)='SOLD'),

                        (SELECT count(`tb3`.`status`) as count3
                            FROM `property_info_additional_brokerage_details` tb3 
                            LEFT JOIN `property_info` tp4  
                            ON `tp4`.`property_id`=`tb3`.`property_id` 
                            WHERE `tp4`.`property_state_id` = `tbl_p`.`property_state_id`
                            AND UPPER(`tb3`.`status`)='FORECLOSURE'),

                        (SELECT count(`tb4`.`status`)
                            FROM `property_info_additional_brokerage_details` tb4
                            LEFT JOIN `property_info` tp5  
                            ON `tp5`.`property_id`=`tb4`.`property_id` 
                            WHERE `tp5`.`property_state_id` = `tbl_p`.`property_state_id`
                            AND UPPER(`tb4`.`status`)='SHORT_SALES'),

                        (SELECT AVG(`tp6`.`property_price`) 
                            FROM `property_info` tp6 
                            WHERE `tp6`.`property_state_id` = `tbl_p`.`property_state_id`),

                        (SELECT MAX(IF(`tp7`.`house_square_footage`,`tp7`.`property_price` / `tp7`.`house_square_footage`,0))  
                            FROM `property_info` tp7 
                            WHERE `tp7`.`property_state_id` = `tbl_p`.`property_state_id`),

                        (SELECT MIN(IF(`tp8`.`house_square_footage`,`tp8`.`property_price` / `tp8`.`house_square_footage`,0))  
                            FROM `property_info` tp8 
                            WHERE `tp8`.`property_state_id` = `tbl_p`.`property_state_id`),

                        (SELECT AVG(IF(`tp9`.`house_square_footage`,`tp9`.`property_price` / `tp9`.`house_square_footage`,0))  
                            FROM `property_info` tp9 
                            WHERE `tp9`.`property_state_id` = `tbl_p`.`property_state_id`)
                    FROM  `property_info` tbl_p 
                    WHERE  `tbl_p`.`property_state_id` !=  ''
                    GROUP BY `tbl_p`.property_state_id
                    
                "
                )->execute()){
             $end = time();
            $query_took = $end-$start;
            return "tbl_cron_market_info_state is done! \r\n Query took ".$query_took." sec. \r\n";
        } else {
             return "Error tbl_cron_market_info_state \r\n";
        }
    }
    
    
    
}
