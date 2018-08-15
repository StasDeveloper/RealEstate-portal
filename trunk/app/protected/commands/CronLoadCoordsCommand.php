<?php

/**
 * Command load photos from queue
 *  ./yiic CronLoadCoords
 */
class CronLoadCoordsCommand extends CConsoleCommand {
    
    private $busyRedisId = 'loadCoordsIsBusy'; // name in Redis
    private $busyRedisTimeout = 90; // sec
    private $error = '';
    private $exceededRedisId = 'loadCoordsIsExceeded'; // name in Redis
    private $exceededRedisTimeout = 7200; // sec
    private $myIp = '';

    public function run() {
        $start = time();
        $col = 0;

        $this->myIp = $this->loadMyIP();

        $this->writeToLog("Start LoadCoords({$this->myIp}) at ". date('Y-m-d H:i:s', $start));
        
        if($this->checkIsExceeded()) {
            $this->writeToLog('Finished # Is Exceeded');
            return;
        }
        
        if(!$this->checkIsBusy() /* || true */) {
            Yii::app()->redisCache->set($this->busyRedisId,1,$this->busyRedisTimeout);
        
            $col = $this->loadCoords();
            
            Yii::app()->redisCache->set($this->busyRedisId,0);

        } else {
            $this->writeToLog("Is Busy");
        }
        $end = time();
        $this->writeToLog('Finished #'.$col.' LoadCoords at '. date('Y-m-d H:i:s', $end) . ' time=' . SiteHelper::timeElapsed($end-$start) . (!empty($this->error)?(' # '.$this->error):''));
    }
    
    private function writeToLog($content) {
        $filename = Yii::app()->basePath.'/runtime/cronLoadCoordslog.txt';
        $fp = fopen($filename, 'a');
        if($fp){
            fwrite($fp, $content."\r\n");
        }
        
        fclose($fp); 
    }
    
    public function loadCoords(){
        if($this->checkIsBusy()) {
            $this->writeToLog("Is blocked for my work"); 
        }
        
        $criteria=new CDbCriteria;
        $criteria->select=array('property_id', 'property_street', 'property_zipcode');
        $criteria->condition='getlongitude = 0.0  AND getlatitude = 0.0 AND property_status = \'Active\'';
        $criteria->limit=30;
        $criteria->order= 'property_id desc';
        $ids = PropertyInfo::model()->with(
                    'city', 
                    'county', 
                    'state', 
                    'zipcode'
                )->findAll($criteria);
        
// $this->writeToLog("sql " . $sql );
        if(count($ids)) {
            $this->writeToLog("Total ".count($ids)." rec. ");
        }
        
        $i=0;

        if ( !empty($ids) ){

            foreach ($ids as $key => $property) {
                $start = time();

                $coords = $this->getCoordsfromGoogle($this->getAddress($property));

                if(empty($this->error)) {
                    $this->checkIsGood($property, $coords);
                } else {
                    return $i;
                }

                $end = time();
                $query_took = $end-$start;
//                $this->writeToLog("#{$key} Query took ".$query_took." sec. ");
                
                // slepping for exclude "exceeded your rate-limit"
                $sleep = rand(1,10);
                usleep($sleep*100000);
                $i++;
            }

        } else {
            $this->writeToLog("Empty list");
        }
        
        return $i;
    }
    
    public function checkIsBusy(){
        return Yii::app()->redisCache->get($this->busyRedisId);
    }

        
    public function checkIsExceeded(){
        return Yii::app()->redisCache->get($this->exceededRedisId.$this->myIp);
    }
    
    public function checkIsGood($property, $coords){
        $DBzipcode = ( /*!empty($property->zipcode)
                &&*/ !empty($property->zipcode->zip_code)
                ?($property->zipcode->zip_code)
                :0);
                if($DBzipcode != $coords['get_zipcode_code']) {
$this->writeToLog(print_r(array(
'id' => $property->property_id ,
'search_keyword' => $coords['search_keyword'] ,
'google' => 'lat='.$coords['get_latitude'] . ' lng=' . $coords['get_longitude'] . ' zip=' . $coords['get_zipcode_code'],
),1));
                }
        if(!empty($coords['get_latitude']) && !empty($coords['get_longitude']))
        {

            //Update Latitude 
            Yii::app()->db->createCommand()->update( 'property_info', array(
                            'getlongitude'=>$coords['get_longitude'],
                            'getlatitude'=>$coords['get_latitude'],
                        ),'property_id=:id',array(':id'=>$property->property_id));
                if($DBzipcode!=$coords['get_zipcode_code'] && !empty($coords['get_zipcode_code']))
                {

                        //Select Zip ID for updating in property_info tabel.
                        $resultZipid=Zipcode::model()->with('city', 'county', 'state')->findByAttributes(array('zip_code'=>$coords['get_zipcode_code']));
                        $numZipId=count($resultZipid);
//$this->writeToLog(print_r(array($numZipId,$resultZipid),1));
                        //If Exist then update in property_info table.
                        if($numZipId>0)
                        {
                            if(!Yii::app()->db->createCommand()->update( 'property_info', array(
                                'property_zipcode'=>$resultZipid->zip_id,
                                'property_city_id'=> !empty($resultZipid->city->cityid)?$resultZipid->city->cityid:0,
                                'property_county_id'=>!empty($resultZipid->city->county_id)?$resultZipid->city->county_id:0,
                                'property_state_id'=>!empty($resultZipid->county->state_id)?$resultZipid->county->state_id:0,
                            ),'property_id=:id',array(':id'=>$property->property_id))) {
                                $this->writeToLog('Not updated property_info #'. $property->property_id.' New zipId #'. $resultZipid->zip_id);
                            } else {
                                $slug = PropertyInfo::model()->makeFullSlug($property->property_id);
                                if(!empty($slug)) {
                                    $propertySlug = PropertyInfoSlug::model()->cache(1000, null)->findByAttributes(array('property_id' => $property->property_id));
                                    $propertySlug->slug = $slug;
                                    $propertySlug->updated_at = new CDbExpression('NOW()');
                                    if(!$propertySlug->save()) {
                                        $this->writeToLog('Not saved update slug='. $slug . ' property_id=' . $property->property_id);
                                    }
                                }
                                $this->writeToLog('Update property_info zipId='. $resultZipid->zip_id);
                            }
                            $zipId=$resultZipid->zip_id;
                        }
                        else //else insert a new id then update that new id in property_info tabel.
                        {
                            /*
                             * @todo Need define all id ( zip city county state )
                             */

                                Yii::app()->db->createCommand()->insert('zipcode', array(
                                    'zip_code'=>$coords['get_zipcode_code']
                                ));
                                $zipId=Yii::app()->db->getLastInsertID('zipcode');

                                $this->writeToLog('Create NEW zipId='. $zipId);

                                if(!Yii::app()->db->createCommand()->update( 'property_info', array(
                                    'property_zipcode'=>$zipId,
                                    'property_city_id'=>0,
                                    'property_county_id'=>0,
                                    'property_state_id'=>0,
                                ),'property_id=:id',array(':id'=>$property->property_id))) {
                                    $this->writeToLog('Not updated property_info #'. $property->property_id.' New zipId #'. $resultZipid->zip_id);
                                } else {
                                    $this->writeToLog('Update property_info zipId='. $zipId);
                                }
                        }

                    Yii::app()->db->createCommand()->insert('property_info_cron_estimated_price', array(
                        'property_zipcode'=>$zipId
                    ));

                }
                else 
                {
                    if($DBzipcode==$coords['get_zipcode_code'] && !empty($coords['get_zipcode_code']))
                    {
//$this->writeToLog('zip code Ok');
                    } else {
                        if(!Yii::app()->db->createCommand()->update( 'property_info', array(
                            'property_status'=>'Inactive',
                        ),'property_id=:id',array(':id'=>$property->property_id))) {
                            $this->writeToLog('Not saved property_info Inactive #'. $property->property_id);
                        } else {
                            $this->writeToLog('NOT defined zip code - set Inactive');
                        }
                    }
                }
        }
        else 
        {
            if(!Yii::app()->db->createCommand()->update( 'property_info', array(
                'property_status'=>'Inactive',
            ),'property_id=:id',array(':id'=>$property->property_id))) {
                $this->writeToLog('Not saved property_info Inactive #'. $property->property_id);
            } else {
                $this->writeToLog('NOT defined coord - set Inactive');
            }
        }
    }
    
    public function getAddress($property){
        $search_keyword = $property->property_street;
        $search_keyword .= !empty($property->city->city_name)?(", " . $property->city->city_name):'';
        $search_keyword .= !empty($property->state->state_code)?(', '.$property->state->state_code):'';
        $search_keyword .= ( !empty($property->zipcode->zip_code)?(" ".$property->zipcode->zip_code):''); 
//$this->writeToLog($search_keyword);

        return $search_keyword; 
    }

    public function getCoordsfromGoogle($search_keyword){
        $get_latitude = 0.0;
        $get_longitude = 0.0;
        $get_zipcode_code = ''; 
        
        $request = 'http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($search_keyword).'&sensor=false';

        $responseStr = @file_get_contents($request);
        $response = json_decode($responseStr); 

        if (isset($response->results[0])) {
            $result = $response->results[0];
            foreach($result->address_components as $addressPart) {

                            //print_r($addressPart);

//                if((in_array('locality', $addressPart->types)) && (in_array('political', $addressPart->types))) {
//                    $city = $addressPart->long_name;
//                }
//                else if((in_array('administrative_area_level_1', $addressPart->types)) && (in_array('political', $addressPart->types))) {
//                    $state = $addressPart->long_name;
//                }
//                else if((in_array('country', $addressPart->types)) && (in_array('political', $addressPart->types))) {
//                    $country = $addressPart->long_name;
//                }
//                else if(in_array('route', $addressPart->types)) { 
//                    $street = $addressPart->long_name;
//                }
//                else if(in_array('street_number', $addressPart->types)) {
//                    $street_number = $addressPart->long_name;
//                }
//                else 
                    if(in_array('postal_code', $addressPart->types)) {
                    $get_zipcode_code = $addressPart->long_name;
                }
            }
        }

        if ($response === false) {
            $this->error = 'The request failed';
            return array('get_latitude' => $get_latitude, 'get_longitude' => $get_longitude,  'get_zipcode_code' => $get_zipcode_code, 'search_keyword' => $search_keyword);
        }

    $get_status_code = isset($response->status)?$response->status:'';
        if($get_status_code=='200' || $get_status_code == 'OK')
        {
            if(isset($response->results[0]->geometry->location->lng)) {
                $get_longitude=$response->results[0]->geometry->location->lng;
            }
            if(isset($response->results[0]->geometry->location->lat)) {
                $get_latitude=$response->results[0]->geometry->location->lat;
            }
        } else if($get_status_code == 'OVER_QUERY_LIMIT') {
            $this->error = 'You have exceeded your rate-limit for this API.';
            Yii::app()->redisCache->set($this->exceededRedisId.$this->myIp, 1, $this->exceededRedisTimeout);
        } else if($get_status_code == 'ZERO_RESULTS') {
        } else {
$this->writeToLog('Unknown status Google API #' . $get_status_code);
        }
        
        return array('get_latitude' => $get_latitude, 'get_longitude' => $get_longitude,  'get_zipcode_code' => $get_zipcode_code, 'search_keyword' => $search_keyword);
    }
    
    public function loadMyIP(){
        $command = '/sbin/ifconfig | /bin/grep inet | /bin/grep -v inet6 | /bin/grep -v 127.0.0.1 | /usr/bin/cut -d: -f2 | /usr/bin/awk \'{printf $1"\n"}\'';
        exec($command, $output);
        return !empty($output[0])?$output[0]:'';
    }
}
