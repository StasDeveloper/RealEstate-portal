<?php

/**
 * This is the model class for table "property_info".
 *
 * The followings are the available columns in table 'property_info':
 * @property integer $property_id
 * @property integer $year_biult_id
 * @property integer $pool
 * @property integer $garages
 * @property integer $mid
 * @property string $property_title
 * @property integer $house_square_footage
 * @property double $lot_acreage
 * @property integer $property_type
 * @property integer $property_price
 * @property integer $bathrooms
 * @property integer $bedrooms
 * @property string $description
 * @property string $property_street
 * @property integer $property_state_id
 * @property integer $property_county_id
 * @property integer $property_city_id
 * @property integer $property_zipcode
 * @property string $property_uploaded_date
 * @property string $property_updated_date
 * @property string $property_expire_date
 * @property string $photo1
 * @property string $caption1
 * @property double $getlongitude
 * @property double $getlatitude
 * @property integer $estimated_price
 * @property integer $percentage_depreciation_value
 * @property integer $comp_stage
 * @property integer $low_range
 * @property integer $high_range
 * @property string $property_status
 * @property string $user_session_id
 * @property string $visible
 * @property string $sub_type
 * @property string $area
 * @property string $subdivision
 * @property string $schools
 * @property string $community_name
 * @property string $community_features
 * @property string $property_fetatures
 * @property integer $mls_sysid
 * @property integer $views
 * @property integer $street_number
 * @property string $street_name
 * @property integer $building_number
 * @property string $location
 * @property string $property_type_mls
 * @property integer $elevator_floor
 * @property string $converted_to_real_property
 * @property string $manufactured
 * @property string $ownership
 * @property string $building_description
 * @property integer $comps
 * @property string $fundamentals_factor
 * @property string $conditional_factor
 * @property string $public_remarks
 */
class PropertyInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'property_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('year_biult_id, pool, garages, mid, property_title, house_square_footage, lot_acreage, property_type, property_price, bathrooms, bedrooms, description, property_street, property_state_id, property_county_id, property_city_id, property_zipcode, property_uploaded_date, property_updated_date, property_expire_date, photo1, caption1, getlongitude, getlatitude, estimated_price, percentage_depreciation_value, user_session_id, sub_type, area, subdivision, schools, community_name, community_features, property_fetatures', 'required'),
			array('year_biult_id, pool, garages, mid, house_square_footage, property_type, property_price, bathrooms, bedrooms, property_state_id, property_county_id, property_city_id, property_zipcode, estimated_price, percentage_depreciation_value, comp_stage, low_range, high_range, mls_sysid, views, street_number, building_number, elevator_floor, comps', 'numerical', 'integerOnly'=>true),
			array('lot_acreage, getlongitude, getlatitude', 'numerical'),
			array('property_title, property_street, caption1', 'length', 'max'=>100),
			array('photo1, area, subdivision, schools', 'length', 'max'=>250),
			array('property_status', 'length', 'max'=>8),
			array('user_session_id', 'length', 'max'=>40),
			array('visible', 'length', 'max'=>1),
			array('sub_type, community_name', 'length', 'max'=>200),
			array('street_name', 'length', 'max'=>50),
			array('location', 'length', 'max'=>12),
			array('property_type_mls', 'length', 'max'=>22),
			array('converted_to_real_property, manufactured', 'length', 'max'=>3),
			array('ownership', 'length', 'max'=>25),
			array('building_description', 'length', 'max'=>64),
			array('fundamentals_factor, conditional_factor', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('property_id, year_biult_id, pool, garages, mid, property_title, house_square_footage, lot_acreage, property_type, property_price, bathrooms, bedrooms, description, property_street, property_state_id, property_county_id, property_city_id, property_zipcode, property_uploaded_date, property_updated_date, property_expire_date, photo1, caption1, getlongitude, getlatitude, estimated_price, percentage_depreciation_value, comp_stage, low_range, high_range, property_status, user_session_id, visible, sub_type, area, subdivision, schools, community_name, community_features, property_fetatures, mls_sysid, views, street_number, street_name, building_number, location, property_type_mls, elevator_floor, converted_to_real_property, manufactured, ownership, building_description, comps, fundamentals_factor, conditional_factor', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'user' => array(self::BELONGS_TO, 'User', 'mid'),
                    'userprofile'=> array(self::HAS_ONE, 'TblUsersProfiles', array('id'=>'mid'),'through'=>'user'),
                    
                    'city' => array(self::BELONGS_TO, 'City', 'property_city_id'),
                    'county' => array(self::BELONGS_TO, 'County', 'property_county_id' ),
                    'state' => array(self::BELONGS_TO, 'State', 'property_state_id'),
                    'zipcode'=> array(self::BELONGS_TO, 'Zipcode', 'property_zipcode'),
                    'propertyInfoAdditionalBrokerageDetails'=> array(self::HAS_ONE, 'PropertyInfoAdditionalBrokerageDetails', 'property_id'),
                    'brokerage_join' => array(self::HAS_ONE, 'BrokerageJoin', array('brokerage_mid'=>'brokerage_id'), 'through'=>'propertyInfoAdditionalBrokerageDetails'),
                    'propertyInfoAdditionalBrokerageDetailsHistory'=> array(self::HAS_ONE, 'PropertyInfoAdditionalBrokerageDetailsHistory', 'property_id'),
                    'propertyInfoAdditionalDetails'=> array(self::HAS_ONE, 'PropertyInfoAdditionalDetails', 'property_id'),
                    'propertyInfoAdditionalDetailsHistory'=> array(self::HAS_ONE, 'PropertyInfoAdditionalDetailsHistory', 'property_id'),
                    'propertyInfoDetails'=> array(self::HAS_ONE, 'PropertyInfoDetails', 'property_id'),
                    'propertyInfoDetailsHistory'=> array(self::HAS_ONE, 'PropertyInfoDetailsHistory', 'property_id'),
                    'propertyInfoHistory'=> array(self::HAS_ONE, 'PropertyInfoHistory', 'property_id'),
                    'propertyInfoPhoto'=> array(self::HAS_MANY, 'PropertyInfoPhoto', array('property_id' => 'mls_sysid')),
                    'eventLogs' => array(self::HAS_MANY, 'PropertyInfoEventLog', 'property_id'),
                    'slug'=> array(self::HAS_ONE, 'PropertyInfoSlug', 'property_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'property_id' => 'Property',
			'year_biult_id' => 'Year Built',
			'pool' => 'Pool',
			'garages' => 'Garages',
			'mid' => 'Mid',
			'property_title' => 'Property Title',
			'house_square_footage' => 'House Square Footage',
			'lot_acreage' => 'Lot Acreage',
			'property_type' => 'Property Type',
			'property_price' => 'Property Price',
			'bathrooms' => 'Bathrooms',
			'bedrooms' => 'Bedrooms',
			'description' => 'Description',
			'property_street' => 'Property Street',
			'property_state_id' => 'Property State',
			'property_county_id' => 'Property County',
			'property_city_id' => 'Property City',
			'property_zipcode' => 'Property Zipcode',
			'property_uploaded_date' => 'Property Uploaded Date',
			'property_updated_date' => 'Property Updated Date',
			'property_expire_date' => 'Property Expire Date',
			'photo1' => 'Photo1',
			'caption1' => 'Caption1',
			'getlongitude' => 'Getlongitude',
			'getlatitude' => 'Getlatitude',
			'estimated_price' => 'Estimated Price',
			'percentage_depreciation_value' => 'Percentage Depreciation Value',
			'comp_stage' => 'Comp Stage',
			'low_range' => 'Low Range',
			'high_range' => 'High Range',
			'property_status' => 'Property Status',
			'user_session_id' => 'User Session',
			'visible' => 'Visible',
			'sub_type' => 'Sub Type',
			'area' => 'Area',
			'subdivision' => 'Subdivision',
			'schools' => 'Schools',
			'community_name' => 'Community Name',
			'community_features' => 'Community Features',
			'property_fetatures' => 'Property Fetatures',
			'mls_sysid' => 'Mls Sysid',
			'views' => 'Views',
			'street_number' => 'Street Number',
			'street_name' => 'Street Name',
			'building_number' => 'Building Number',
			'location' => 'Location',
			'property_type_mls' => 'Property Type Mls',
			'elevator_floor' => 'Elevator Floor',
			'converted_to_real_property' => 'Converted To Real Property',
			'manufactured' => 'Manufactured',
			'ownership' => 'Ownership',
			'building_description' => 'Building Description',
			'comps' => 'Comps',
			'fundamentals_factor' => 'Fundamentals Factor',
			'conditional_factor' => 'Conditional Factor',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('property_id',$this->property_id);
		$criteria->compare('year_biult_id',$this->year_biult_id);
		$criteria->compare('pool',$this->pool);
		$criteria->compare('garages',$this->garages);
		$criteria->compare('mid',$this->mid);
		$criteria->compare('property_title',$this->property_title,true);
		$criteria->compare('house_square_footage',$this->house_square_footage);
		$criteria->compare('lot_acreage',$this->lot_acreage);
		$criteria->compare('property_type',$this->property_type);
		$criteria->compare('property_price',$this->property_price);
		$criteria->compare('bathrooms',$this->bathrooms);
		$criteria->compare('bedrooms',$this->bedrooms);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('property_street',$this->property_street,true);
		$criteria->compare('property_state_id',$this->property_state_id);
		$criteria->compare('property_county_id',$this->property_county_id);
		$criteria->compare('property_city_id',$this->property_city_id);
		$criteria->compare('property_zipcode',$this->property_zipcode);
		$criteria->compare('property_uploaded_date',$this->property_uploaded_date,true);
		$criteria->compare('property_updated_date',$this->property_updated_date,true);
		$criteria->compare('property_expire_date',$this->property_expire_date,true);
		$criteria->compare('photo1',$this->photo1,true);
		$criteria->compare('caption1',$this->caption1,true);
		$criteria->compare('getlongitude',$this->getlongitude);
		$criteria->compare('getlatitude',$this->getlatitude);
		$criteria->compare('estimated_price',$this->estimated_price);
		$criteria->compare('percentage_depreciation_value',$this->percentage_depreciation_value);
		$criteria->compare('comp_stage',$this->comp_stage);
		$criteria->compare('low_range',$this->low_range);
		$criteria->compare('high_range',$this->high_range);
		$criteria->compare('property_status',$this->property_status,true);
		$criteria->compare('user_session_id',$this->user_session_id,true);
		$criteria->compare('visible',$this->visible,true);
		$criteria->compare('sub_type',$this->sub_type,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('subdivision',$this->subdivision,true);
		$criteria->compare('schools',$this->schools,true);
		$criteria->compare('community_name',$this->community_name,true);
		$criteria->compare('community_features',$this->community_features,true);
		$criteria->compare('property_fetatures',$this->property_fetatures,true);
		$criteria->compare('mls_sysid',$this->mls_sysid);
		$criteria->compare('views',$this->views);
		$criteria->compare('street_number',$this->street_number);
		$criteria->compare('street_name',$this->street_name,true);
		$criteria->compare('building_number',$this->building_number);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('property_type_mls',$this->property_type_mls,true);
		$criteria->compare('elevator_floor',$this->elevator_floor);
		$criteria->compare('converted_to_real_property',$this->converted_to_real_property,true);
		$criteria->compare('manufactured',$this->manufactured,true);
		$criteria->compare('ownership',$this->ownership,true);
		$criteria->compare('building_description',$this->building_description,true);
		$criteria->compare('comps',$this->comps);
		$criteria->compare('fundamentals_factor',$this->fundamentals_factor,true);
		$criteria->compare('conditional_factor',$this->conditional_factor,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PropertyInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getPropertyType($key = null) {
        if($key === null) {
            $key = $this->property_type;
        }
        $res = '';
        $property_type_array = array(
            '0' => 'Unknown',
            '1' => 'Single Family Home',
            '2' => 'Condo',
            '3' => 'Townhouse',
            '4' => 'Multi Family',
            '5' => 'Land',
            '6' => 'Mobile Home',
            '7' => 'Manufactured Home',
            '8' => 'Time Share',
            '9' => 'Rental',
            '16' => 'High Rise');
        if (array_key_exists($key , $property_type_array)) {
            $res = $property_type_array[$key];
        }
        return $res;
    }

    public function getDiscontValue(){
        $discont = 0;
        //if (($search_result->percentage_depreciation_value >= 10)) {
        if (($this->percentage_depreciation_value >= Yii::app()->params['underValueDeals'])) {
            $discont = $this->percentage_depreciation_value;
        }
        if ($discont == 0) {
            if (( ($this->estimated_price > 0) &&
                (100 - ($this->property_price * 100 / $this->estimated_price)) > 0)) {
                $discont = 100 - ($this->property_price * 100 / $this->estimated_price);
            }
        }

        return $discont;
    }



    public function planEmailAlerts(){

        $savedSearches = SavedSearch::model()->findAll();

        if(!$savedSearches || count($savedSearches) <=0)
            return;



        $multi = new CDbMultiInsertCommand(new PlannedEmailAlert());

        foreach($savedSearches as $savedSearch){
            if($savedSearch->email_alert_freq == SavedSearch::EMAIL_FREQ_NEVER){
                PlannedEmailAlert::model()->deleteAll('saved_search_id = :saved_search_id' , array(':saved_search_id'=>$savedSearch->id));
                continue;
            }


            if(!$savedSearch->isMatch($this)){
                // if user update property and then didnt match now - cancel email
                PlannedEmailAlert::model()->deleteAll('saved_search_id = :saved_search_id AND property_id=:property_id' , array(
                    ':saved_search_id'=>$savedSearch->id,
                    ':property_id'=>$this->property_id,
                ));
                continue;
            }

            // plan email
            //echo $savedSearch->name.': '. $this->property_id.'<br>';


            // if already exist - update frequency
            $plannedMail = PlannedEmailAlert::model()->find("saved_search_id=:saved_search_id AND property_id=:property_id", array(
                ':saved_search_id'=>$savedSearch->id,
                ':property_id'=>$this->property_id,
            ));


            if($plannedMail == null){
                // add new
                $plannedMail = new PlannedEmailAlert();
                $plannedMail->saved_search_id = $savedSearch->id;
                $plannedMail->property_id = $this->property_id;
                $plannedMail->email_freq = $savedSearch->email_alert_freq;
                $multi->add($plannedMail, false);
            }else{
                // update freq if not match
                if($plannedMail->email_freq != $savedSearch->email_alert_freq){
                    $plannedMail->email_freq = $savedSearch->email_alert_freq;
                    $plannedMail->save();
                }
            }
        }
        $multi->execute();
    }

    public function isTodayAlreadyRunEvent($eventType, DateTime $today=null){

        $db_format = 'Y-m-d';
        $db_full_format = 'Y-m-d H:i:s';

        if($today == null)
            $today = new DateTime('now');

        foreach($this->eventLogs as $eventLog){
            if($eventLog->type == $eventType &&
                $eventLog->property_id == $this->property_id
            ){
                $run_at_datetime = DateTime::createFromFormat($db_full_format, $eventLog->run_at);

                if($run_at_datetime->format($db_format) ==  $today->format($db_format))
                    return true;
            }
        }

        return false;
    }

    /**
     * run by cron
     * /var/www/html/irradii.com/trunk/app/protected/yiic CronPropertyInfoEventRunner
     */
    public function onCreateEvent(){
        $this->planEmailAlerts();
    }

    /**
     * run by cron
     * /var/www/html/irradii.com/trunk/app/protected/yiic CronPropertyInfoEventRunner
     */
    public function onUpdateEvent(){

        $this->planEmailAlerts();
    }
    
    public function getPropertyTypeSTR( $id = false ) {
        if($id) {
            $property = PropertyInfo::model()->cache(1000, null)->findByAttributes(array('property_id' => $id));
        } else {
            $property = $this;
        }
        
        $property_type_array = array('0' => 'Unknown', '1' => 'Single Family Home', '2' => 'Condo', '3' => 'Townhouse', '4' => 'Multi Family', '5' => 'Land', '6' => 'Mobile Home', '7' => 'Manufactured Home', '8' => 'Time Share', '9' => 'Rental', '16' => 'High Rise');
        
        return !empty($property_type_array[$property->property_type])?$property_type_array[$property->property_type]:'';
    }

    public function getFullAddress( $id = false ) {
        if($id) {
            $property = PropertyInfo::model()->cache(1000, null)->with('city', 'county', 'state', 'zipcode')->findByAttributes(array('property_id' => $id));
        } else {
            $property = $this;
        }
        $address = $property->property_street;
        $address .= !empty($address)?' ':'';
        if(empty($property->city_name)) {
            $address .= !empty($property->city->city_name)?$property->city->city_name:'';
        } else {
            $address .= $property->city_name;
        }
        $address = ucwords(strtolower($address));
        
        $address .= !empty($address)?', ':'';
        if(empty($property->state_code)) {
            $address .= !empty($property->state->state_code)?strtoupper($property->state->state_code):'';
        } else {
            $address .= $property->state_code;
        }
        
        $address .= !empty($address)?' ':'';
        if(empty($property->zip_code)) {
            $address .= !empty($property->zipcode->zip_code)?strtoupper($property->zipcode->zip_code):'';
        } else {
            $address .= $property->zip_code;
        }
        
        return $address;
    }
    
    public function makeFullSlug( $id = false ) {
        
        $slug = $checkslug = Doctrine_Inflector::urlize($this->getFullAddress($id));

        if(empty($this->slug)) {
            $counter = 0;
            while ( PropertyInfoSlug::model()->findByAttributes(array('slug' => $checkslug)) ) {
                $checkslug = sprintf('%s-%d', $slug, ++$counter);
            }
        } else {
            if(!empty($this->slug->id)) {
                $counter = 0;
                while ( PropertyInfoSlug::model()->findByAttributes(array('slug' => $checkslug),'id <> :id',array(':id' => $this->slug->id)) ) {
                    $checkslug = sprintf('%s-%d', $slug, ++$counter);
                }
            }
        }


        return $counter > 0 ? $checkslug : $slug;
    }

    public function getFullSlug( $id = false ) {
        if(!$id) {
            $id = $this->property_id;
        }
        $propertySlug = PropertyInfoSlug::model()->cache(1000, null)->findByAttributes(array('property_id' => $id));
        return !empty($propertySlug->slug)?$propertySlug->slug:false;
    }
 
    public function countPhoto( ) {
        $count = 0;
        
        if(!empty($this->photo1)) {
            $count++;
        }
        // @todo array - old relation self::HAS_MANY 
        if(!empty($this->propertyInfoPhoto[0])) {
            for($i=2;$i<=40;$i++) {
                $name = 'photo' . $i;
                if(!empty($this->propertyInfoPhoto[0]->$name)) {
                    $count++;
                } else {
                    break;
                }
            }
        }
        return $count;
    }
    
    public function getCity_name( ) {
        return !empty($this->city)&&!empty($this->city->city_name)?$this->city->city_name:'';
    }

    public function getStatus (){
        return $this->propertyInfoAdditionalBrokerageDetails->status;
    }
    
    public function getState_code( ) {
        return !empty($this->state)&&!empty($this->state->state_code)?$this->state->state_code:'';
    }
    
    public function getZip_code( ) {
        return !empty($this->zipcode)&&!empty($this->zipcode->zip_code)?$this->zipcode->zip_code:'';
    }

    /**
     * Show difference between TMV and AskedPrice
     *
     * @param $trueMV
     * @param $price
     * @return mixed
     */
    public function getEstimatedEquity($trueMV, $price){
        if($trueMV > $price){
            $estimatedEquity = $trueMV - $price;
            return $estimatedEquity;
        }
    }

    /**
     * Get updated date for search result table on property/search page
     *
     * @return bool|string
     */
    public function getUpdatedDateViaStatus(){
        if (isset($this->propertyInfoAdditionalBrokerageDetails->status)) {
            $prop_stat_caps = strtoupper($this->propertyInfoAdditionalBrokerageDetails->status);
            if ('HISTORY' == $prop_stat_caps || 'CLOSED' == $prop_stat_caps) {
                $updatedDate = $this->propertyInfoAdditionalBrokerageDetails->actual_close_date;
            }
            else if (
                'FOR SALE' == $prop_stat_caps
                || 'ACTIVE' == $prop_stat_caps
                || 'ACTIVE-EXCLUSIVE RIGHT' == $prop_stat_caps
                || 'EXCLUSIVE AGENCY' == $prop_stat_caps
                || 'CONTINGENT OFFER' == $prop_stat_caps
                || 'PENDING OFFER' == $prop_stat_caps
                || 'EXPIRED' == $prop_stat_caps
            ) {
                $updatedDate = $this->propertyInfoAdditionalBrokerageDetails->list_date;
            }
            else {
                $updatedDate = $this->property_updated_date;
            }
        }
        else {
            $updatedDate = $this->property_updated_date;
        }

        if($updatedDate === null){
            $updatedDate = $this->property_updated_date;
        }

        $updatedDate = date("Y-m-d", strtotime($updatedDate));

        return $updatedDate;
    }

}
