<?php

/**
 * This is the model class for table "brokerage_join".
 *
 * The followings are the available columns in table 'brokerage_join':
 * @property integer $brokerage_id
 * @property integer $mid
 * @property string $brokerage_name
 * @property string $brokerage_phone
 * @property string $brokerage_phone_fax
 * @property string $brokerage_phone_home
 * @property string $brokerage_phone_mobile
 * @property string $brokerage_address
 * @property string $brokerage_zipcode
 * @property string $brokerage_logo_image_link
 * @property string $brokerage_website_address
 * @property integer $timestamp
 */
class BrokerageJoin extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'brokerage_join';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mid, brokerage_name, brokerage_phone, brokerage_phone_fax, brokerage_phone_home, brokerage_phone_mobile, brokerage_address, brokerage_zipcode, brokerage_logo_image_link, brokerage_website_address, timestamp', 'required'),
			array('mid, timestamp', 'numerical', 'integerOnly'=>true),
			array('brokerage_name', 'length', 'max'=>100),
			array('brokerage_phone', 'length', 'max'=>15),
			array('brokerage_phone_fax, brokerage_phone_home, brokerage_phone_mobile', 'length', 'max'=>30),
			array('brokerage_address', 'length', 'max'=>200),
			array('brokerage_zipcode', 'length', 'max'=>10),
			array('brokerage_logo_image_link, brokerage_website_address', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('brokerage_id, mid, brokerage_name, brokerage_phone, brokerage_phone_fax, brokerage_phone_home, brokerage_phone_mobile, brokerage_address, brokerage_zipcode, brokerage_logo_image_link, brokerage_website_address, timestamp', 'safe', 'on'=>'search'),
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
			'brokerage_id' => 'Brokerage',
			'mid' => 'Mid',
			'brokerage_name' => 'Brokerage Name',
			'brokerage_phone' => 'Brokerage Phone',
			'brokerage_phone_fax' => 'Brokerage Phone Fax',
			'brokerage_phone_home' => 'Brokerage Phone Home',
			'brokerage_phone_mobile' => 'Brokerage Phone Mobile',
			'brokerage_address' => 'Brokerage Address',
			'brokerage_zipcode' => 'Brokerage Zipcode',
			'brokerage_logo_image_link' => 'Brokerage Logo Image Link',
			'brokerage_website_address' => 'Brokerage Website Address',
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

		$criteria->compare('brokerage_id',$this->brokerage_id);
		$criteria->compare('mid',$this->mid);
		$criteria->compare('brokerage_name',$this->brokerage_name,true);
		$criteria->compare('brokerage_phone',$this->brokerage_phone,true);
		$criteria->compare('brokerage_phone_fax',$this->brokerage_phone_fax,true);
		$criteria->compare('brokerage_phone_home',$this->brokerage_phone_home,true);
		$criteria->compare('brokerage_phone_mobile',$this->brokerage_phone_mobile,true);
		$criteria->compare('brokerage_address',$this->brokerage_address,true);
		$criteria->compare('brokerage_zipcode',$this->brokerage_zipcode,true);
		$criteria->compare('brokerage_logo_image_link',$this->brokerage_logo_image_link,true);
		$criteria->compare('brokerage_website_address',$this->brokerage_website_address,true);
		$criteria->compare('timestamp',$this->timestamp);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BrokerageJoin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
