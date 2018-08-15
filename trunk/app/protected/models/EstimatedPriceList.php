<?php

/**
 * This is the model class for table "estimated_price_list".
 *
 * The followings are the available columns in table 'estimated_price_list':
 * @property integer $estimated_price_id
 * @property integer $upload_id
 * @property integer $sqft_id
 * @property integer $zipcode_id
 * @property double $LP_Sqft
 * @property double $LotAcre
 * @property double $Amenity
 */
class EstimatedPriceList extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'estimated_price_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('upload_id, sqft_id, zipcode_id, LP_Sqft, LotAcre, Amenity', 'required'),
			array('upload_id, sqft_id, zipcode_id', 'numerical', 'integerOnly'=>true),
			array('LP_Sqft, LotAcre, Amenity', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('estimated_price_id, upload_id, sqft_id, zipcode_id, LP_Sqft, LotAcre, Amenity', 'safe', 'on'=>'search'),
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
			'estimated_price_id' => 'Estimated Price',
			'upload_id' => 'Upload',
			'sqft_id' => 'Sqft',
			'zipcode_id' => 'Zipcode',
			'LP_Sqft' => 'Lp Sqft',
			'LotAcre' => 'Lot Acre',
			'Amenity' => 'Amenity',
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

		$criteria->compare('estimated_price_id',$this->estimated_price_id);
		$criteria->compare('upload_id',$this->upload_id);
		$criteria->compare('sqft_id',$this->sqft_id);
		$criteria->compare('zipcode_id',$this->zipcode_id);
		$criteria->compare('LP_Sqft',$this->LP_Sqft);
		$criteria->compare('LotAcre',$this->LotAcre);
		$criteria->compare('Amenity',$this->Amenity);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EstimatedPriceList the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
