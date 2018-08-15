<?php

/**
 * This is the model class for table "{{subscription_ipn_log}}".
 *
 * The followings are the available columns in table '{{subscription_ipn_log}}':
 * @property integer $id
 * @property string $txn_type
 * @property string $subscr_id
 * @property integer $user_id
 * @property string $custom
 * @property string $process_step
 * @property string $full_post
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class SubscriptionIpnLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{subscription_ipn_log}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('txn_type, subscr_id', 'length', 'max'=>128),
			array('custom, process_step, full_post, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, txn_type, subscr_id, user_id, custom, process_step, full_post, created_at, updated_at', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'txn_type' => 'Txn Type',
			'subscr_id' => 'Subscr',
			'user_id' => 'User',
			'custom' => 'Custom',
			'process_step' => 'Process Step',
			'full_post' => 'Full Post',
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
		$criteria->compare('txn_type',$this->txn_type,true);
		$criteria->compare('subscr_id',$this->subscr_id,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('custom',$this->custom,true);
		$criteria->compare('process_step',$this->process_step,true);
		$criteria->compare('full_post',$this->full_post,true);
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
	 * @return SubscriptionIpnLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
