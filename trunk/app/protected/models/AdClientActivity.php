<?php

/**
 * This is the model class for table "{{ad_client_activity}}".
 *
 * The followings are the available columns in table '{{ad_client_activity}}':
 * @property integer $id
 * @property integer $status_activity
 * @property integer $client_id
 * @property integer $user_id
 * @property string $user_first_name
 * @property string $user_last_name
 * @property string $user_phone_number
 * @property string $user_email
 * @property string $user_address
 * @property string $user_comment
 * @property double $user_lon
 * @property double $user_lat
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property AdClient $client
 * @property Users $user
 */
class AdClientActivity extends CActiveRecord
{
    
    const PENDING_APPROVAL=1;
    const APPROVED=2;
    const SENDED=3;
    
    public $verifyCode;

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ad_client_activity}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_first_name, user_last_name, user_email, user_phone_number, user_address', 'required'),
			array('status_activity, client_id, user_id', 'numerical', 'integerOnly'=>true),
			array('user_lon, user_lat', 'numerical'),
			array('user_first_name, user_last_name, user_email', 'length', 'max'=>128),
			array('user_phone_number', 'length', 'max'=>15),
			array('user_email', 'email'),
			array('user_address', 'length', 'max'=>256),
                        array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'on'=>'guest'), // 
			array('user_comment, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, status_activity, client_id, user_id, user_first_name, user_last_name, user_phone_number, user_email, user_address, user_comment, user_lon, user_lat, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'client' => array(self::BELONGS_TO, 'AdClient', 'client_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

        public function behaviors() {
            return array(
                'CTimestampBehavior' => array(
                    'class' => 'zii.behaviors.CTimestampBehavior',
                    'createAttribute' => 'created_at',
                    'updateAttribute' => 'updated_at',
                )
            );
        }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'status_activity' => 'Status',
			'client_id' => 'Client',
			'user_id' => 'User',
			'user_first_name' => 'First Name',
			'user_last_name' => 'Last Name',
			'user_phone_number' => 'Phone Number',
			'user_email' => 'Email',
			'user_address' => 'Address',
			'user_comment' => 'Comment',
			'user_lon' => 'User Lon',
			'user_lat' => 'User Lat',
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
                $criteria->with = array('client');
		$criteria->compare('id',$this->id);
		$criteria->compare('status_activity',$this->status_activity);
		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_first_name',$this->user_first_name,true);
		$criteria->compare('user_last_name',$this->user_last_name,true);
		$criteria->compare('user_phone_number',$this->user_phone_number,true);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('user_address',$this->user_address,true);
		$criteria->compare('user_comment',$this->user_comment,true);
		$criteria->compare('user_lon',$this->user_lon);
		$criteria->compare('user_lat',$this->user_lat);
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
	 * @return AdClientActivity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
