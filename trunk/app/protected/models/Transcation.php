<?php

/**
 * This is the model class for table "transcation".
 *
 * The followings are the available columns in table 'transcation':
 * @property integer $TRID
 * @property integer $mid
 * @property string $reference_code
 * @property string $reference_id
 * @property double $amount
 * @property string $date_time
 * @property string $payment_transaction_info
 * @property string $payer_email
 * @property string $expire_date
 * @property string $ip_address
 */
class Transcation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'transcation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mid, reference_code, reference_id, amount, date_time, payment_transaction_info, expire_date, ip_address', 'required'),
			array('mid', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('reference_code, reference_id', 'length', 'max'=>70),
			array('payment_transaction_info', 'length', 'max'=>80),
			array('payer_email', 'length', 'max'=>200),
			array('ip_address', 'length', 'max'=>40),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('TRID, mid, reference_code, reference_id, amount, date_time, payment_transaction_info, payer_email, expire_date, ip_address', 'safe', 'on'=>'search'),
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
			'TRID' => 'Trid',
			'mid' => 'Mid',
			'reference_code' => 'Reference Code',
			'reference_id' => 'Reference',
			'amount' => 'Amount',
			'date_time' => 'Date Time',
			'payment_transaction_info' => 'Payment Transaction Info',
			'payer_email' => 'Payer Email',
			'expire_date' => 'Expire Date',
			'ip_address' => 'Ip Address',
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

		$criteria->compare('TRID',$this->TRID);
		$criteria->compare('mid',$this->mid);
		$criteria->compare('reference_code',$this->reference_code,true);
		$criteria->compare('reference_id',$this->reference_id,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('date_time',$this->date_time,true);
		$criteria->compare('payment_transaction_info',$this->payment_transaction_info,true);
		$criteria->compare('payer_email',$this->payer_email,true);
		$criteria->compare('expire_date',$this->expire_date,true);
		$criteria->compare('ip_address',$this->ip_address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Transcation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
