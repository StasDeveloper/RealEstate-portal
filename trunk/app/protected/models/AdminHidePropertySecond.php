<?php

/**
 * This is the model class for table "admin_hide_property_second".
 *
 * The followings are the available columns in table 'admin_hide_property_second':
 * @property integer $hide_property_second_id
 * @property string $SquareFootage
 * @property string $YearBuild
 * @property string $LotAcreage
 * @property string $Bathrooms
 * @property string $ListPrice
 * @property string $ComparableValue
 * @property integer $timestamp
 */
class AdminHidePropertySecond extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'admin_hide_property_second';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SquareFootage, YearBuild, LotAcreage, Bathrooms, ListPrice, ComparableValue, timestamp', 'required'),
			array('timestamp', 'numerical', 'integerOnly'=>true),
			array('SquareFootage, YearBuild, LotAcreage, Bathrooms, ListPrice, ComparableValue', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('hide_property_second_id, SquareFootage, YearBuild, LotAcreage, Bathrooms, ListPrice, ComparableValue, timestamp', 'safe', 'on'=>'search'),
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
			'hide_property_second_id' => 'Hide Property Second',
			'SquareFootage' => 'Square Footage',
			'YearBuild' => 'Year Build',
			'LotAcreage' => 'Lot Acreage',
			'Bathrooms' => 'Bathrooms',
			'ListPrice' => 'List Price',
			'ComparableValue' => 'Comparable Value',
			'timestamp' => 'Timestamp',
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

		$criteria->compare('hide_property_second_id',$this->hide_property_second_id);
		$criteria->compare('SquareFootage',$this->SquareFootage,true);
		$criteria->compare('YearBuild',$this->YearBuild,true);
		$criteria->compare('LotAcreage',$this->LotAcreage,true);
		$criteria->compare('Bathrooms',$this->Bathrooms,true);
		$criteria->compare('ListPrice',$this->ListPrice,true);
		$criteria->compare('ComparableValue',$this->ComparableValue,true);
		$criteria->compare('timestamp',$this->timestamp);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdminHidePropertySecond the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
