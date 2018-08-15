<?php

/**
 * This is the model class for table "registration_step2".
 *
 * The followings are the available columns in table 'registration_step2':
 * @property integer $regstep2_id
 * @property integer $mid
 * @property integer $state_id
 * @property integer $county_id
 * @property integer $city_id
 * @property integer $zipcode_id
 * @property double $total_amount
 * @property string $step2_date
 * @property integer $payment_status
 * @property integer $payment_type
 * @property string $reference
 * @property integer $TRID
 * @property string $subscription_date
 * @property string $expire_date
 */
class RegistrationStep2 extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'registration_step2';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('payment_type', 'required'),
			array('mid, state_id, county_id, city_id, zipcode_id, payment_status, payment_type, TRID', 'numerical', 'integerOnly'=>true),
			array('total_amount', 'numerical'),
			array('reference', 'length', 'max'=>20),
			array('step2_date, subscription_date, expire_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('regstep2_id, mid, state_id, county_id, city_id, zipcode_id, total_amount, step2_date, payment_status, payment_type, reference, TRID, subscription_date, expire_date', 'safe', 'on'=>'search'),
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
			'regstep2_id' => 'Regstep2',
			'mid' => 'Mid',
			'state_id' => 'State',
			'county_id' => 'County',
			'city_id' => 'City',
			'zipcode_id' => 'Zipcode',
			'total_amount' => 'Total Amount',
			'step2_date' => 'Step2 Date',
			'payment_status' => 'Payment Status',
			'payment_type' => 'Payment Type',
			'reference' => 'Reference',
			'TRID' => 'Trid',
			'subscription_date' => 'Subscription Date',
			'expire_date' => 'Expire Date',
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

		$criteria->compare('regstep2_id',$this->regstep2_id);
		$criteria->compare('mid',$this->mid);
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('county_id',$this->county_id);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('zipcode_id',$this->zipcode_id);
		$criteria->compare('total_amount',$this->total_amount);
		$criteria->compare('step2_date',$this->step2_date,true);
		$criteria->compare('payment_status',$this->payment_status);
		$criteria->compare('payment_type',$this->payment_type);
		$criteria->compare('reference',$this->reference,true);
		$criteria->compare('TRID',$this->TRID);
		$criteria->compare('subscription_date',$this->subscription_date,true);
		$criteria->compare('expire_date',$this->expire_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RegistrationStep2 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
