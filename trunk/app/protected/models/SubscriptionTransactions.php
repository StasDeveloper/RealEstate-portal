<?php

/**
 * This is the model class for table "{{subscription_transactions}}".
 *
 * The followings are the available columns in table '{{subscription_transactions}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $site_sbsrc_id
 * @property string $txn_id
 * @property string $payment_date
 * @property string $txn_type
 * @property string $subscr_id
 * @property integer $recurring
 * @property string $item_name
 * @property string $payment_status
 * @property string $payment_gross
 * @property string $mc_gross
 * @property string $mc_currency
 * @property string $business
 * @property string $payer_status
 * @property string $payer_email
 * @property string $receiver_email
 * @property string $custom
 * @property string $full_txn_info
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Subscriptions $subscription
 */
class SubscriptionTransactions extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{subscription_transactions}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, site_sbsrc_id, recurring', 'numerical', 'integerOnly'=>true),
			array('txn_id', 'length', 'max'=>256),
			array('txn_type, subscr_id, payment_status, mc_currency, payer_status', 'length', 'max'=>128),
			array('item_name, business, payer_email, receiver_email', 'length', 'max'=>255),
			array('payment_gross, mc_gross', 'length', 'max'=>10),
			array('payment_date, custom, full_txn_info, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, site_sbsrc_id, txn_id, payment_date, txn_type, subscr_id, recurring, item_name, payment_status, payment_gross, mc_gross, mc_currency, business, payer_status, payer_email, receiver_email, custom, full_txn_info, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'subscription' => array(self::BELONGS_TO, 'Subscriptions', 'site_sbsrc_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'site_sbsrc_id' => 'Site Subscription',
			'txn_id' => 'Txn',
			'payment_date' => 'Payment Date',
			'txn_type' => 'Txn Type',
			'subscr_id' => 'Subscr',
			'recurring' => 'Recurring',
			'item_name' => 'Item Name',
			'payment_status' => 'Payment Status',
			'payment_gross' => 'Payment Gross',
			'mc_gross' => 'Mc Gross',
			'mc_currency' => 'Mc Currency',
			'business' => 'Business',
			'payer_status' => 'Payer Status',
			'payer_email' => 'Payer Email',
			'receiver_email' => 'Receiver Email',
			'custom' => 'Custom',
			'full_txn_info' => 'Full Txn Info',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('site_sbsrc_id',$this->site_sbsrc_id);
		$criteria->compare('txn_id',$this->txn_id,true);
		$criteria->compare('payment_date',$this->payment_date,true);
		$criteria->compare('txn_type',$this->txn_type,true);
		$criteria->compare('subscr_id',$this->subscr_id,true);
		$criteria->compare('recurring',$this->recurring);
		$criteria->compare('item_name',$this->item_name,true);
		$criteria->compare('payment_status',$this->payment_status,true);
		$criteria->compare('payment_gross',$this->payment_gross,true);
		$criteria->compare('mc_gross',$this->mc_gross,true);
		$criteria->compare('mc_currency',$this->mc_currency,true);
		$criteria->compare('business',$this->business,true);
		$criteria->compare('payer_status',$this->payer_status,true);
		$criteria->compare('payer_email',$this->payer_email,true);
		$criteria->compare('receiver_email',$this->receiver_email,true);
		$criteria->compare('custom',$this->custom,true);
		$criteria->compare('full_txn_info',$this->full_txn_info,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SubscriptionTransactions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
