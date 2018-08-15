<?php

/**
 * This is the model class for table "member_search_option".
 *
 * The followings are the available columns in table 'member_search_option':
 * @property integer $search_option_id
 * @property integer $mid
 * @property string $saved_search_title
 * @property integer $percentage_depreciation_value
 * @property string $search_keyword
 * @property integer $state_id
 * @property integer $county_id
 * @property integer $city_id
 * @property integer $zip_id
 * @property integer $year_biult_id
 * @property integer $year_biuld_to
 * @property string $property_price_from_range
 * @property string $property_price_to_range
 * @property integer $square_footage_from
 * @property integer $square_footage_to
 * @property double $lots_size_from
 * @property double $lots_size_to
 * @property integer $property_type
 * @property integer $bedrooms
 * @property integer $bathrooms
 * @property string $garages
 * @property integer $over_all_property
 * @property string $amenities_refrigerator
 * @property string $amenities_stove_id
 * @property string $amenities_dishwasher
 * @property string $amenities_washer_id
 * @property string $amenities_gated_community
 * @property string $amenities_fireplace_id
 * @property string $amenities_parking_id
 * @property string $amenities_microwave
 * @property string $pool
 * @property string $spa
 * @property string $search_keyword_attribute
 * @property integer $photos_only
 * @property integer $alerts
 */
class MemberSearchOption extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'member_search_option';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mid, saved_search_title, percentage_depreciation_value, search_keyword, state_id, county_id, city_id, zip_id, year_biult_id, year_biuld_to, property_price_from_range, property_price_to_range, square_footage_from, square_footage_to, lots_size_from, lots_size_to, property_type, bedrooms, bathrooms, garages, over_all_property, amenities_refrigerator, amenities_stove_id, amenities_dishwasher, amenities_washer_id, amenities_gated_community, amenities_fireplace_id, amenities_parking_id, amenities_microwave, pool, spa, search_keyword_attribute, photos_only', 'required'),
			array('mid, percentage_depreciation_value, state_id, county_id, city_id, zip_id, year_biult_id, year_biuld_to, square_footage_from, square_footage_to, property_type, bedrooms, bathrooms, over_all_property, photos_only, alerts', 'numerical', 'integerOnly'=>true),
			array('lots_size_from, lots_size_to', 'numerical'),
			array('saved_search_title, search_keyword', 'length', 'max'=>100),
			array('property_price_from_range, property_price_to_range', 'length', 'max'=>10),
			array('garages, amenities_refrigerator, amenities_stove_id, amenities_dishwasher, amenities_washer_id, amenities_gated_community, amenities_fireplace_id, amenities_parking_id, amenities_microwave, pool, spa', 'length', 'max'=>2),
			array('search_keyword_attribute', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('search_option_id, mid, saved_search_title, percentage_depreciation_value, search_keyword, state_id, county_id, city_id, zip_id, year_biult_id, year_biuld_to, property_price_from_range, property_price_to_range, square_footage_from, square_footage_to, lots_size_from, lots_size_to, property_type, bedrooms, bathrooms, garages, over_all_property, amenities_refrigerator, amenities_stove_id, amenities_dishwasher, amenities_washer_id, amenities_gated_community, amenities_fireplace_id, amenities_parking_id, amenities_microwave, pool, spa, search_keyword_attribute, photos_only, alerts', 'safe', 'on'=>'search'),
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
			'search_option_id' => 'Search Option',
			'mid' => 'Mid',
			'saved_search_title' => 'Saved Search Title',
			'percentage_depreciation_value' => 'Percentage Depreciation Value',
			'search_keyword' => 'Search Keyword',
			'state_id' => 'State',
			'county_id' => 'County',
			'city_id' => 'City',
			'zip_id' => 'Zip',
			'year_biult_id' => 'Year Biult',
			'year_biuld_to' => 'Year Biuld To',
			'property_price_from_range' => 'Property Price From Range',
			'property_price_to_range' => 'Property Price To Range',
			'square_footage_from' => 'Square Footage From',
			'square_footage_to' => 'Square Footage To',
			'lots_size_from' => 'Lots Size From',
			'lots_size_to' => 'Lots Size To',
			'property_type' => 'Property Type',
			'bedrooms' => 'Bedrooms',
			'bathrooms' => 'Bathrooms',
			'garages' => 'Garages',
			'over_all_property' => 'Over All Property',
			'amenities_refrigerator' => 'Amenities Refrigerator',
			'amenities_stove_id' => 'Amenities Stove',
			'amenities_dishwasher' => 'Amenities Dishwasher',
			'amenities_washer_id' => 'Amenities Washer',
			'amenities_gated_community' => 'Amenities Gated Community',
			'amenities_fireplace_id' => 'Amenities Fireplace',
			'amenities_parking_id' => 'Amenities Parking',
			'amenities_microwave' => 'Amenities Microwave',
			'pool' => 'Pool',
			'spa' => 'Spa',
			'search_keyword_attribute' => 'Search Keyword Attribute',
			'photos_only' => 'Photos Only',
			'alerts' => 'Alerts',
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

		$criteria->compare('search_option_id',$this->search_option_id);
		$criteria->compare('mid',$this->mid);
		$criteria->compare('saved_search_title',$this->saved_search_title,true);
		$criteria->compare('percentage_depreciation_value',$this->percentage_depreciation_value);
		$criteria->compare('search_keyword',$this->search_keyword,true);
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('county_id',$this->county_id);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('zip_id',$this->zip_id);
		$criteria->compare('year_biult_id',$this->year_biult_id);
		$criteria->compare('year_biuld_to',$this->year_biuld_to);
		$criteria->compare('property_price_from_range',$this->property_price_from_range,true);
		$criteria->compare('property_price_to_range',$this->property_price_to_range,true);
		$criteria->compare('square_footage_from',$this->square_footage_from);
		$criteria->compare('square_footage_to',$this->square_footage_to);
		$criteria->compare('lots_size_from',$this->lots_size_from);
		$criteria->compare('lots_size_to',$this->lots_size_to);
		$criteria->compare('property_type',$this->property_type);
		$criteria->compare('bedrooms',$this->bedrooms);
		$criteria->compare('bathrooms',$this->bathrooms);
		$criteria->compare('garages',$this->garages,true);
		$criteria->compare('over_all_property',$this->over_all_property);
		$criteria->compare('amenities_refrigerator',$this->amenities_refrigerator,true);
		$criteria->compare('amenities_stove_id',$this->amenities_stove_id,true);
		$criteria->compare('amenities_dishwasher',$this->amenities_dishwasher,true);
		$criteria->compare('amenities_washer_id',$this->amenities_washer_id,true);
		$criteria->compare('amenities_gated_community',$this->amenities_gated_community,true);
		$criteria->compare('amenities_fireplace_id',$this->amenities_fireplace_id,true);
		$criteria->compare('amenities_parking_id',$this->amenities_parking_id,true);
		$criteria->compare('amenities_microwave',$this->amenities_microwave,true);
		$criteria->compare('pool',$this->pool,true);
		$criteria->compare('spa',$this->spa,true);
		$criteria->compare('search_keyword_attribute',$this->search_keyword_attribute,true);
		$criteria->compare('photos_only',$this->photos_only);
		$criteria->compare('alerts',$this->alerts);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MemberSearchOption the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
