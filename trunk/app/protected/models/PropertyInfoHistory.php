<?php

/**
 * This is the model class for table "property_info_history".
 *
 * The followings are the available columns in table 'property_info_history':
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
 */
class PropertyInfoHistory extends CActiveRecord
{

	public $id;

	public $property_info_slug;

//	public $slug;

	public function getId(){
		return $this->history_id;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'property_info_history';
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
			array('year_biult_id, pool, garages, mid, house_square_footage, property_type, property_price, bathrooms, bedrooms, property_state_id, property_county_id, property_city_id, property_zipcode, estimated_price, percentage_depreciation_value, mls_sysid', 'numerical', 'integerOnly'=>true),
			array('lot_acreage, getlongitude, getlatitude', 'numerical'),
			array('property_title, property_street, caption1', 'length', 'max'=>100),
			array('photo1, area, subdivision, schools', 'length', 'max'=>250),
			array('property_status', 'length', 'max'=>8),
			array('user_session_id', 'length', 'max'=>40),
			array('visible', 'length', 'max'=>1),
			array('sub_type, community_name', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('property_id, year_biult_id, pool, garages, mid, property_title, house_square_footage, lot_acreage, property_type, property_price, bathrooms, bedrooms, description, property_street, property_state_id, property_county_id, property_city_id, property_zipcode, property_uploaded_date, property_updated_date, property_expire_date, photo1, caption1, getlongitude, getlatitude, estimated_price, percentage_depreciation_value, property_status, user_session_id, visible, sub_type, area, subdivision, schools, community_name, community_features, property_fetatures, mls_sysid, property_info_slug', 'safe', 'on'=>'search'),
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
			'property_info'=> array(self::BELONGS_TO, 'PropertyInfo', 'property_id'),

			'city' => array(self::BELONGS_TO, 'City', 'property_city_id'),
			'county' => array(self::BELONGS_TO, 'County', 'property_county_id' ),
			'state' => array(self::BELONGS_TO, 'State', 'property_state_id'),
			'zipcode'=> array(self::BELONGS_TO, 'Zipcode', 'property_zipcode'),


			//remove code below if needed
			'propertyInfoAdditionalBrokerageDetails'=> array(self::HAS_ONE, 'PropertyInfoAdditionalBrokerageDetailsHistory', array('property_id'=>'property_id')),
			'brokerage_join' => array(self::HAS_ONE, 'BrokerageJoin', array('brokerage_mid'=>'brokerage_id'), 'through'=>'propertyInfoAdditionalBrokerageDetailsHistory'),
			'propertyInfoAdditionalBrokerageDetailsHistory'=> array(self::HAS_ONE, 'PropertyInfoAdditionalBrokerageDetailsHistory', 'property_id'),
			'propertyInfoAdditionalDetails'=> array(self::HAS_ONE, 'PropertyInfoAdditionalDetailsHistory', array('property_id'=>'property_id')),
			'propertyInfoAdditionalDetailsHistory'=> array(self::HAS_ONE, 'PropertyInfoAdditionalDetailsHistory', 'property_id'),
			'propertyInfoDetails'=> array(self::HAS_ONE, 'PropertyInfoDetailsHistory', array('property_id'=>'property_id')),
			'propertyInfoDetailsHistory'=> array(self::HAS_ONE, 'PropertyInfoDetailsHistory', 'property_id'),
			'propertyInfoHistory'=> array(self::HAS_ONE, 'PropertyInfoHistory', array('property_id'=>'property_id')),
			'propertyInfoPhoto'=> array(self::HAS_MANY, 'PropertyInfoPhoto', array('property_id' => 'mls_sysid')),

			'property_info_mlsSysid'=> array(self::HAS_ONE, 'PropertyInfo', array('mls_sysid' => 'mls_sysid')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'property_id' => 'Property',
			'year_biult_id' => 'Year Biult',
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

		$criteria = new CDbCriteria;

		$criteria->compare('t.property_id',$this->property_id);
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
		$criteria->compare('t.mls_sysid',$this->mls_sysid);

		// make enable search via slug-field
		$criteria->with = array(
			'property_info_mlsSysid.slug' => array(
				'select'=>'property_info_mlsSysid.slug.slug',
				'together'=>true
			),
			'city', 'county', 'state', 'zipcode'
		);

		$criteria->compare('slug.slug', $this->property_info_slug, true);
//		$criteria->compare('slug', $this->slug, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PropertyInfoHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getHistorySlug( $id = false ) {
		if($id) {
			$property = PropertyInfoHistory::model()->cache(1000, null)->with('city', 'county', 'state', 'zipcode')->findByAttributes(array('property_id' => $id));
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

		$slug = $checkslug = Doctrine_Inflector::urlize($address);
		return $slug;
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

}
