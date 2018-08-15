<?php

/**
 * This is the model class for table "property_info_details_history".
 *
 * The followings are the available columns in table 'property_info_details_history':
 * @property integer $property_detail_id
 * @property integer $property_id
 * @property string $stories
 * @property integer $spa
 * @property string $apt_suite
 * @property integer $amenities_stove_id
 * @property integer $amenities_refrigerator
 * @property integer $amenities_dishwasher
 * @property integer $amenities_washer_id
 * @property integer $amenities_fireplace_id
 * @property integer $amenities_parking_id
 * @property integer $amenities_microwave
 * @property integer $amenities_gated_community
 * @property string $photo2
 * @property string $caption2
 * @property string $photo3
 * @property string $caption3
 * @property string $photo4
 * @property string $caption4
 * @property string $photo5
 * @property string $caption5
 * @property string $interior_features
 * @property string $exterior_features
 * @property integer $first_sale_type
 * @property integer $second_sale_type
 * @property double $property_repair_price
 * @property string $reference
 */
class PropertyInfoDetailsHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'property_info_details_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('property_id, stories, spa, apt_suite, amenities_stove_id, amenities_refrigerator, amenities_dishwasher, amenities_washer_id, amenities_fireplace_id, amenities_parking_id, amenities_microwave, amenities_gated_community, caption2, caption3, caption4, caption5, interior_features, exterior_features, first_sale_type, second_sale_type, property_repair_price, reference', 'required'),
			array('property_id, spa, amenities_stove_id, amenities_refrigerator, amenities_dishwasher, amenities_washer_id, amenities_fireplace_id, amenities_parking_id, amenities_microwave, amenities_gated_community, first_sale_type, second_sale_type', 'numerical', 'integerOnly'=>true),
			array('property_repair_price', 'numerical'),
			array('stories', 'length', 'max'=>30),
			array('apt_suite, caption2, caption3, caption4, caption5', 'length', 'max'=>100),
			array('photo2, photo3, photo4, photo5', 'length', 'max'=>250),
			array('reference', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('property_detail_id, property_id, stories, spa, apt_suite, amenities_stove_id, amenities_refrigerator, amenities_dishwasher, amenities_washer_id, amenities_fireplace_id, amenities_parking_id, amenities_microwave, amenities_gated_community, photo2, caption2, photo3, caption3, photo4, caption4, photo5, caption5, interior_features, exterior_features, first_sale_type, second_sale_type, property_repair_price, reference', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'property_detail_id' => 'Property Detail',
			'property_id' => 'Property',
			'stories' => 'Stories',
			'spa' => 'Spa',
			'apt_suite' => 'Apt Suite',
			'amenities_stove_id' => 'Amenities Stove',
			'amenities_refrigerator' => 'Amenities Refrigerator',
			'amenities_dishwasher' => 'Amenities Dishwasher',
			'amenities_washer_id' => 'Amenities Washer',
			'amenities_fireplace_id' => 'Amenities Fireplace',
			'amenities_parking_id' => 'Amenities Parking',
			'amenities_microwave' => 'Amenities Microwave',
			'amenities_gated_community' => 'Amenities Gated Community',
			'photo2' => 'Photo2',
			'caption2' => 'Caption2',
			'photo3' => 'Photo3',
			'caption3' => 'Caption3',
			'photo4' => 'Photo4',
			'caption4' => 'Caption4',
			'photo5' => 'Photo5',
			'caption5' => 'Caption5',
			'interior_features' => 'Interior Features',
			'exterior_features' => 'Exterior Features',
			'first_sale_type' => 'First Sale Type',
			'second_sale_type' => 'Second Sale Type',
			'property_repair_price' => 'Property Repair Price',
			'reference' => 'Reference',
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

		$criteria->compare('property_detail_id',$this->property_detail_id);
		$criteria->compare('property_id',$this->property_id);
		$criteria->compare('stories',$this->stories,true);
		$criteria->compare('spa',$this->spa);
		$criteria->compare('apt_suite',$this->apt_suite,true);
		$criteria->compare('amenities_stove_id',$this->amenities_stove_id);
		$criteria->compare('amenities_refrigerator',$this->amenities_refrigerator);
		$criteria->compare('amenities_dishwasher',$this->amenities_dishwasher);
		$criteria->compare('amenities_washer_id',$this->amenities_washer_id);
		$criteria->compare('amenities_fireplace_id',$this->amenities_fireplace_id);
		$criteria->compare('amenities_parking_id',$this->amenities_parking_id);
		$criteria->compare('amenities_microwave',$this->amenities_microwave);
		$criteria->compare('amenities_gated_community',$this->amenities_gated_community);
		$criteria->compare('photo2',$this->photo2,true);
		$criteria->compare('caption2',$this->caption2,true);
		$criteria->compare('photo3',$this->photo3,true);
		$criteria->compare('caption3',$this->caption3,true);
		$criteria->compare('photo4',$this->photo4,true);
		$criteria->compare('caption4',$this->caption4,true);
		$criteria->compare('photo5',$this->photo5,true);
		$criteria->compare('caption5',$this->caption5,true);
		$criteria->compare('interior_features',$this->interior_features,true);
		$criteria->compare('exterior_features',$this->exterior_features,true);
		$criteria->compare('first_sale_type',$this->first_sale_type);
		$criteria->compare('second_sale_type',$this->second_sale_type);
		$criteria->compare('property_repair_price',$this->property_repair_price);
		$criteria->compare('reference',$this->reference,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PropertyInfoDetailsHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
