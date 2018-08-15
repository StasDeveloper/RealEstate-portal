<?php

/**
 * This is the model class for table "compare_estimated_price_table".
 *
 * The followings are the available columns in table 'compare_estimated_price_table':
 * @property integer $compare_estimate_id
 * @property integer $property_type
 * @property integer $stage
 * @property string $year_estimated
 * @property string $lot_estimated
 * @property string $house_estimated
 * @property string $lot_weighted
 * @property string $house_weighted
 * @property string $amenties_weighted
 * @property string $distance
 * @property integer $beds_estimated
 * @property integer $baths_estimated
 * @property integer $subdivision_comp
 * @property integer $min_comp
 * @property integer $house_views_comp
 */
class CompareEstimatedPriceTable extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'compare_estimated_price_table';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('property_type, stage, year_estimated, lot_estimated, house_estimated, lot_weighted, house_weighted, amenties_weighted, distance', 'required'),
			array('property_type, stage, beds_estimated, baths_estimated, subdivision_comp, min_comp, house_views_comp', 'numerical', 'integerOnly'=>true),
			array('year_estimated, lot_estimated, house_estimated, lot_weighted, house_weighted, amenties_weighted', 'length', 'max'=>30),
			array('distance', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('compare_estimate_id, property_type, stage, year_estimated, lot_estimated, house_estimated, lot_weighted, house_weighted, amenties_weighted, distance, beds_estimated, baths_estimated, subdivision_comp, min_comp, house_views_comp', 'safe', 'on'=>'search'),
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
			'compare_estimate_id' => 'Compare Estimate',
			'property_type' => 'Property Type',
			'stage' => 'Stage',
			'year_estimated' => 'Year Estimated',
			'lot_estimated' => 'Lot Estimated',
			'house_estimated' => 'House Estimated',
			'lot_weighted' => 'Lot Weighted',
			'house_weighted' => 'House Weighted',
			'amenties_weighted' => 'Amenties Weighted',
			'distance' => 'Distance',
			'beds_estimated' => 'Beds Estimated',
			'baths_estimated' => 'Baths Estimated',
			'subdivision_comp' => 'Subdivision Comp',
			'min_comp' => 'Min Comp',
			'house_views_comp' => 'House Views Comp',
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

		$criteria->compare('compare_estimate_id',$this->compare_estimate_id);
		$criteria->compare('property_type',$this->property_type);
		$criteria->compare('stage',$this->stage);
		$criteria->compare('year_estimated',$this->year_estimated,true);
		$criteria->compare('lot_estimated',$this->lot_estimated,true);
		$criteria->compare('house_estimated',$this->house_estimated,true);
		$criteria->compare('lot_weighted',$this->lot_weighted,true);
		$criteria->compare('house_weighted',$this->house_weighted,true);
		$criteria->compare('amenties_weighted',$this->amenties_weighted,true);
		$criteria->compare('distance',$this->distance,true);
		$criteria->compare('beds_estimated',$this->beds_estimated);
		$criteria->compare('baths_estimated',$this->baths_estimated);
		$criteria->compare('subdivision_comp',$this->subdivision_comp);
		$criteria->compare('min_comp',$this->min_comp);
		$criteria->compare('house_views_comp',$this->house_views_comp);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CompareEstimatedPriceTable the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
