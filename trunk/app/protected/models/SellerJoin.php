<?php

/**
 * This is the model class for table "seller_join".
 *
 * The followings are the available columns in table 'seller_join':
 * @property integer $seller_id
 * @property integer $mid
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $address1
 * @property string $address2
 * @property integer $zipcode
 * @property string $phone
 * @property string $AUDIT_EXPIRE_DATE
 */
class SellerJoin extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'seller_join';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mid, zipcode', 'numerical', 'integerOnly'=>true),
			array('first_name, middle_name, last_name', 'length', 'max'=>50),
			array('address1, address2', 'length', 'max'=>100),
			array('phone', 'length', 'max'=>20),
			array('AUDIT_EXPIRE_DATE', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('seller_id, mid, first_name, middle_name, last_name, address1, address2, zipcode, phone, AUDIT_EXPIRE_DATE', 'safe', 'on'=>'search'),
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
			'seller_id' => 'Seller',
			'mid' => 'Mid',
			'first_name' => 'First Name',
			'middle_name' => 'Middle Name',
			'last_name' => 'Last Name',
			'address1' => 'Address1',
			'address2' => 'Address2',
			'zipcode' => 'Zipcode',
			'phone' => 'Phone',
			'AUDIT_EXPIRE_DATE' => 'Audit Expire Date',
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

		$criteria->compare('seller_id',$this->seller_id);
		$criteria->compare('mid',$this->mid);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('address1',$this->address1,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('zipcode',$this->zipcode);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('AUDIT_EXPIRE_DATE',$this->AUDIT_EXPIRE_DATE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SellerJoin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
