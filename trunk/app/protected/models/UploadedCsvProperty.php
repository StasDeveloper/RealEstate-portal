<?php

/**
 * This is the model class for table "uploaded_csv_property".
 *
 * The followings are the available columns in table 'uploaded_csv_property':
 * @property string $date_acquired
 * @property string $property_type
 * @property string $sub_type
 * @property string $property_status
 * @property string $mls_id
 * @property string $getlongitude
 * @property string $getlatitude
 * @property string $property_street
 * @property string $property_city
 * @property string $property_state
 * @property string $property_zipcode
 * @property string $property_price
 * @property string $bedrooms
 * @property string $bathrooms
 * @property string $house_square_footage
 * @property string $stories
 * @property string $garages
 * @property string $pool
 * @property string $spa
 * @property string $year_biult_id
 * @property string $lot_acreage
 * @property string $amenities_fireplace_id
 * @property string $amenities_stove
 * @property string $amenities_refrigerator
 * @property string $amenities_dishwasher
 * @property string $agent_name
 * @property string $agent_phone_office
 * @property string $agent_phone_fax
 * @property string $agent_phone_home
 * @property string $agent_phone_mobile
 * @property string $agent_email
 * @property string $agent_address
 * @property string $agent_city
 * @property string $agent_state
 * @property string $agent_zipcode
 * @property string $agent_website_address
 * @property string $brokerage_name
 * @property string $brokerage_phone_office
 * @property string $brokerage_phone_fax
 * @property string $brokerage_phone_home
 * @property string $brokerage_phone_mobile
 * @property string $brokerage_email
 * @property string $brokerage_address
 * @property string $brokerage_city
 * @property string $brokerage_state
 * @property string $brokerage_zipcode
 * @property string $brokerage_logo_image_link
 * @property string $brokerage_website_address
 * @property string $area
 * @property string $subdivision
 * @property string $schools
 * @property string $community_name
 * @property string $community_features
 * @property string $property_description
 * @property string $property_fetatures
 * @property string $fireplace_features
 * @property string $heating_features
 * @property string $exterior_construction_features
 * @property string $roofing_features
 * @property string $interior_features
 * @property string $exterior_features
 * @property string $sales_history
 * @property string $tax_history
 * @property string $foreclosure
 * @property string $short_sale
 * @property string $title
 * @property string $page_link
 * @property string $photo1
 * @property string $photo2
 * @property string $photo3
 * @property string $photo4
 * @property string $photo5
 * @property string $photo6
 * @property string $photo7
 * @property string $photo8
 * @property string $photo9
 * @property string $photo10
 * @property string $photo11
 * @property string $photo12
 * @property string $photo13
 * @property string $photo14
 * @property string $photo15
 * @property string $photo16
 * @property string $photo17
 * @property string $photo18
 * @property string $photo19
 * @property string $photo20
 * @property string $photo21
 * @property string $photo22
 * @property string $photo23
 * @property string $photo24
 * @property string $photo25
 * @property string $uploaded_time
 * @property string $expire_date
 * @property integer $timestamp
 * @property string $property_county
 * @property integer $csv_uploaded_id
 */
class UploadedCsvProperty extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'uploaded_csv_property';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_acquired, property_type, sub_type, property_status, mls_id, getlongitude, getlatitude, property_street, property_city, property_state, property_zipcode, property_price, bedrooms, bathrooms, house_square_footage, stories, garages, pool, spa, year_biult_id, lot_acreage, amenities_fireplace_id, amenities_stove, amenities_refrigerator, amenities_dishwasher, agent_name, agent_phone_office, agent_phone_fax, agent_phone_home, agent_phone_mobile, agent_email, agent_address, agent_city, agent_state, agent_zipcode, agent_website_address, brokerage_name, brokerage_phone_office, brokerage_phone_fax, brokerage_phone_home, brokerage_phone_mobile, brokerage_email, brokerage_address, brokerage_city, brokerage_state, brokerage_zipcode, brokerage_logo_image_link, brokerage_website_address, area, subdivision, schools, community_name, community_features, property_description, property_fetatures, fireplace_features, heating_features, exterior_construction_features, roofing_features, interior_features, exterior_features, sales_history, tax_history, foreclosure, short_sale, title, page_link, photo23, photo24, photo25, uploaded_time, expire_date, timestamp, property_county', 'required'),
			array('timestamp', 'numerical', 'integerOnly'=>true),
			array('date_acquired, agent_phone_fax, agent_phone_home, agent_phone_mobile, agent_city, agent_state, brokerage_phone_fax, brokerage_phone_home, brokerage_phone_mobile, brokerage_city, brokerage_state, uploaded_time, expire_date', 'length', 'max'=>30),
			array('property_type, property_city, property_state, agent_website_address, brokerage_logo_image_link, brokerage_website_address, page_link', 'length', 'max'=>150),
			array('sub_type, agent_address, brokerage_address, community_name', 'length', 'max'=>200),
			array('property_status, heating_features, roofing_features, sales_history, tax_history, foreclosure, property_county', 'length', 'max'=>50),
			array('mls_id, property_zipcode, agent_zipcode, brokerage_zipcode', 'length', 'max'=>10),
			array('getlongitude, getlatitude, property_price, house_square_footage, stories, lot_acreage, fireplace_features', 'length', 'max'=>20),
			array('property_street, agent_name, agent_email, brokerage_name, brokerage_email, title', 'length', 'max'=>100),
			array('bedrooms, bathrooms, garages, pool, spa, amenities_fireplace_id, amenities_stove, amenities_refrigerator, amenities_dishwasher', 'length', 'max'=>5),
			array('year_biult_id', 'length', 'max'=>6),
			array('agent_phone_office, brokerage_phone_office, short_sale', 'length', 'max'=>15),
			array('area, subdivision, schools, exterior_construction_features, photo1, photo2, photo3, photo4, photo5, photo6, photo7, photo8, photo9, photo10, photo11, photo12, photo13, photo14, photo15, photo16, photo17, photo18, photo19, photo20, photo21, photo22, photo23, photo24, photo25', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('date_acquired, property_type, sub_type, property_status, mls_id, getlongitude, getlatitude, property_street, property_city, property_state, property_zipcode, property_price, bedrooms, bathrooms, house_square_footage, stories, garages, pool, spa, year_biult_id, lot_acreage, amenities_fireplace_id, amenities_stove, amenities_refrigerator, amenities_dishwasher, agent_name, agent_phone_office, agent_phone_fax, agent_phone_home, agent_phone_mobile, agent_email, agent_address, agent_city, agent_state, agent_zipcode, agent_website_address, brokerage_name, brokerage_phone_office, brokerage_phone_fax, brokerage_phone_home, brokerage_phone_mobile, brokerage_email, brokerage_address, brokerage_city, brokerage_state, brokerage_zipcode, brokerage_logo_image_link, brokerage_website_address, area, subdivision, schools, community_name, community_features, property_description, property_fetatures, fireplace_features, heating_features, exterior_construction_features, roofing_features, interior_features, exterior_features, sales_history, tax_history, foreclosure, short_sale, title, page_link, photo1, photo2, photo3, photo4, photo5, photo6, photo7, photo8, photo9, photo10, photo11, photo12, photo13, photo14, photo15, photo16, photo17, photo18, photo19, photo20, photo21, photo22, photo23, photo24, photo25, uploaded_time, expire_date, timestamp, property_county, csv_uploaded_id', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'date_acquired' => 'Date Acquired',
			'property_type' => 'Property Type',
			'sub_type' => 'Sub Type',
			'property_status' => 'Property Status',
			'mls_id' => 'Mls',
			'getlongitude' => 'Getlongitude',
			'getlatitude' => 'Getlatitude',
			'property_street' => 'Property Street',
			'property_city' => 'Property City',
			'property_state' => 'Property State',
			'property_zipcode' => 'Property Zipcode',
			'property_price' => 'Property Price',
			'bedrooms' => 'Bedrooms',
			'bathrooms' => 'Bathrooms',
			'house_square_footage' => 'House Square Footage',
			'stories' => 'Stories',
			'garages' => 'Garages',
			'pool' => 'Pool',
			'spa' => 'Spa',
			'year_biult_id' => 'Year Biult',
			'lot_acreage' => 'Lot Acreage',
			'amenities_fireplace_id' => 'Amenities Fireplace',
			'amenities_stove' => 'Amenities Stove',
			'amenities_refrigerator' => 'Amenities Refrigerator',
			'amenities_dishwasher' => 'Amenities Dishwasher',
			'agent_name' => 'Agent Name',
			'agent_phone_office' => 'Agent Phone Office',
			'agent_phone_fax' => 'Agent Phone Fax',
			'agent_phone_home' => 'Agent Phone Home',
			'agent_phone_mobile' => 'Agent Phone Mobile',
			'agent_email' => 'Agent Email',
			'agent_address' => 'Agent Address',
			'agent_city' => 'Agent City',
			'agent_state' => 'Agent State',
			'agent_zipcode' => 'Agent Zipcode',
			'agent_website_address' => 'Agent Website Address',
			'brokerage_name' => 'Brokerage Name',
			'brokerage_phone_office' => 'Brokerage Phone Office',
			'brokerage_phone_fax' => 'Brokerage Phone Fax',
			'brokerage_phone_home' => 'Brokerage Phone Home',
			'brokerage_phone_mobile' => 'Brokerage Phone Mobile',
			'brokerage_email' => 'Brokerage Email',
			'brokerage_address' => 'Brokerage Address',
			'brokerage_city' => 'Brokerage City',
			'brokerage_state' => 'Brokerage State',
			'brokerage_zipcode' => 'Brokerage Zipcode',
			'brokerage_logo_image_link' => 'Brokerage Logo Image Link',
			'brokerage_website_address' => 'Brokerage Website Address',
			'area' => 'Area',
			'subdivision' => 'Subdivision',
			'schools' => 'Schools',
			'community_name' => 'Community Name',
			'community_features' => 'Community Features',
			'property_description' => 'Property Description',
			'property_fetatures' => 'Property Fetatures',
			'fireplace_features' => 'Fireplace Features',
			'heating_features' => 'Heating Features',
			'exterior_construction_features' => 'Exterior Construction Features',
			'roofing_features' => 'Roofing Features',
			'interior_features' => 'Interior Features',
			'exterior_features' => 'Exterior Features',
			'sales_history' => 'Sales History',
			'tax_history' => 'Tax History',
			'foreclosure' => 'Foreclosure',
			'short_sale' => 'Short Sale',
			'title' => 'Title',
			'page_link' => 'Page Link',
			'photo1' => 'Photo1',
			'photo2' => 'Photo2',
			'photo3' => 'Photo3',
			'photo4' => 'Photo4',
			'photo5' => 'Photo5',
			'photo6' => 'Photo6',
			'photo7' => 'Photo7',
			'photo8' => 'Photo8',
			'photo9' => 'Photo9',
			'photo10' => 'Photo10',
			'photo11' => 'Photo11',
			'photo12' => 'Photo12',
			'photo13' => 'Photo13',
			'photo14' => 'Photo14',
			'photo15' => 'Photo15',
			'photo16' => 'Photo16',
			'photo17' => 'Photo17',
			'photo18' => 'Photo18',
			'photo19' => 'Photo19',
			'photo20' => 'Photo20',
			'photo21' => 'Photo21',
			'photo22' => 'Photo22',
			'photo23' => 'Photo23',
			'photo24' => 'Photo24',
			'photo25' => 'Photo25',
			'uploaded_time' => 'Uploaded Time',
			'expire_date' => 'Expire Date',
			'timestamp' => 'Timestamp',
			'property_county' => 'Property County',
			'csv_uploaded_id' => 'Csv Uploaded',
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

		$criteria->compare('date_acquired',$this->date_acquired,true);
		$criteria->compare('property_type',$this->property_type,true);
		$criteria->compare('sub_type',$this->sub_type,true);
		$criteria->compare('property_status',$this->property_status,true);
		$criteria->compare('mls_id',$this->mls_id,true);
		$criteria->compare('getlongitude',$this->getlongitude,true);
		$criteria->compare('getlatitude',$this->getlatitude,true);
		$criteria->compare('property_street',$this->property_street,true);
		$criteria->compare('property_city',$this->property_city,true);
		$criteria->compare('property_state',$this->property_state,true);
		$criteria->compare('property_zipcode',$this->property_zipcode,true);
		$criteria->compare('property_price',$this->property_price,true);
		$criteria->compare('bedrooms',$this->bedrooms,true);
		$criteria->compare('bathrooms',$this->bathrooms,true);
		$criteria->compare('house_square_footage',$this->house_square_footage,true);
		$criteria->compare('stories',$this->stories,true);
		$criteria->compare('garages',$this->garages,true);
		$criteria->compare('pool',$this->pool,true);
		$criteria->compare('spa',$this->spa,true);
		$criteria->compare('year_biult_id',$this->year_biult_id,true);
		$criteria->compare('lot_acreage',$this->lot_acreage,true);
		$criteria->compare('amenities_fireplace_id',$this->amenities_fireplace_id,true);
		$criteria->compare('amenities_stove',$this->amenities_stove,true);
		$criteria->compare('amenities_refrigerator',$this->amenities_refrigerator,true);
		$criteria->compare('amenities_dishwasher',$this->amenities_dishwasher,true);
		$criteria->compare('agent_name',$this->agent_name,true);
		$criteria->compare('agent_phone_office',$this->agent_phone_office,true);
		$criteria->compare('agent_phone_fax',$this->agent_phone_fax,true);
		$criteria->compare('agent_phone_home',$this->agent_phone_home,true);
		$criteria->compare('agent_phone_mobile',$this->agent_phone_mobile,true);
		$criteria->compare('agent_email',$this->agent_email,true);
		$criteria->compare('agent_address',$this->agent_address,true);
		$criteria->compare('agent_city',$this->agent_city,true);
		$criteria->compare('agent_state',$this->agent_state,true);
		$criteria->compare('agent_zipcode',$this->agent_zipcode,true);
		$criteria->compare('agent_website_address',$this->agent_website_address,true);
		$criteria->compare('brokerage_name',$this->brokerage_name,true);
		$criteria->compare('brokerage_phone_office',$this->brokerage_phone_office,true);
		$criteria->compare('brokerage_phone_fax',$this->brokerage_phone_fax,true);
		$criteria->compare('brokerage_phone_home',$this->brokerage_phone_home,true);
		$criteria->compare('brokerage_phone_mobile',$this->brokerage_phone_mobile,true);
		$criteria->compare('brokerage_email',$this->brokerage_email,true);
		$criteria->compare('brokerage_address',$this->brokerage_address,true);
		$criteria->compare('brokerage_city',$this->brokerage_city,true);
		$criteria->compare('brokerage_state',$this->brokerage_state,true);
		$criteria->compare('brokerage_zipcode',$this->brokerage_zipcode,true);
		$criteria->compare('brokerage_logo_image_link',$this->brokerage_logo_image_link,true);
		$criteria->compare('brokerage_website_address',$this->brokerage_website_address,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('subdivision',$this->subdivision,true);
		$criteria->compare('schools',$this->schools,true);
		$criteria->compare('community_name',$this->community_name,true);
		$criteria->compare('community_features',$this->community_features,true);
		$criteria->compare('property_description',$this->property_description,true);
		$criteria->compare('property_fetatures',$this->property_fetatures,true);
		$criteria->compare('fireplace_features',$this->fireplace_features,true);
		$criteria->compare('heating_features',$this->heating_features,true);
		$criteria->compare('exterior_construction_features',$this->exterior_construction_features,true);
		$criteria->compare('roofing_features',$this->roofing_features,true);
		$criteria->compare('interior_features',$this->interior_features,true);
		$criteria->compare('exterior_features',$this->exterior_features,true);
		$criteria->compare('sales_history',$this->sales_history,true);
		$criteria->compare('tax_history',$this->tax_history,true);
		$criteria->compare('foreclosure',$this->foreclosure,true);
		$criteria->compare('short_sale',$this->short_sale,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('page_link',$this->page_link,true);
		$criteria->compare('photo1',$this->photo1,true);
		$criteria->compare('photo2',$this->photo2,true);
		$criteria->compare('photo3',$this->photo3,true);
		$criteria->compare('photo4',$this->photo4,true);
		$criteria->compare('photo5',$this->photo5,true);
		$criteria->compare('photo6',$this->photo6,true);
		$criteria->compare('photo7',$this->photo7,true);
		$criteria->compare('photo8',$this->photo8,true);
		$criteria->compare('photo9',$this->photo9,true);
		$criteria->compare('photo10',$this->photo10,true);
		$criteria->compare('photo11',$this->photo11,true);
		$criteria->compare('photo12',$this->photo12,true);
		$criteria->compare('photo13',$this->photo13,true);
		$criteria->compare('photo14',$this->photo14,true);
		$criteria->compare('photo15',$this->photo15,true);
		$criteria->compare('photo16',$this->photo16,true);
		$criteria->compare('photo17',$this->photo17,true);
		$criteria->compare('photo18',$this->photo18,true);
		$criteria->compare('photo19',$this->photo19,true);
		$criteria->compare('photo20',$this->photo20,true);
		$criteria->compare('photo21',$this->photo21,true);
		$criteria->compare('photo22',$this->photo22,true);
		$criteria->compare('photo23',$this->photo23,true);
		$criteria->compare('photo24',$this->photo24,true);
		$criteria->compare('photo25',$this->photo25,true);
		$criteria->compare('uploaded_time',$this->uploaded_time,true);
		$criteria->compare('expire_date',$this->expire_date,true);
		$criteria->compare('timestamp',$this->timestamp);
		$criteria->compare('property_county',$this->property_county,true);
		$criteria->compare('csv_uploaded_id',$this->csv_uploaded_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UploadedCsvProperty the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
