<?php

/**
 * This is the model class for table "{{subscriptions}}".
 *
 * The followings are the available columns in table '{{subscriptions}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $trans_id
 * @property string $subscr_id
 * @property integer $subscription_id
 * @property string $payment_date
 * @property string $status
 * @property integer $items_count
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property SubscriptionTransactions $trans
 * @property Users $user
 * @property SubscriptionPlans $subscription
 */
class Subscriptions extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{subscriptions}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, subscription_id, items_count', 'numerical', 'integerOnly'=>true),
			array('subscr_id, trans_id', 'length', 'max'=>255),
			array('status', 'length', 'max'=>128),
			array('payment_date, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, trans_id, subscr_id, subscription_id, payment_date, status, items_count, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'subscription' => array(self::BELONGS_TO, 'SubscriptionPlans', 'subscription_id'),
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
			'trans_id' => 'Trans',
			'subscr_id' => 'Subscr id',
			'subscription_id' => 'Subscription',
			'payment_date' => 'Payment Date',
			'status' => 'Status',
			'items_count' => 'Items Count',
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
		$criteria->compare('trans_id',$this->trans_id);
		$criteria->compare('subscr_id',$this->subscr_id);
		$criteria->compare('subscription_id',$this->subscription_id);
		$criteria->compare('payment_date',$this->payment_date,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('items_count',$this->items_count);
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
	 * @return Subscriptions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
