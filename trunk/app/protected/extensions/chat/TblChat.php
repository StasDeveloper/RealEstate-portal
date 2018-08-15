<?php

/**
 * This is the model class for table "{{chat}}".
 *
 * The followings are the available columns in table '{{chat}}':
 * @property integer $id_chat
 * @property integer $owner_room
 * @property integer $collocutor_id
 * @property integer $author_id
 * @property string $chat_message
 * @property string $chat_created
 * @property string $type
 */
class TblChat extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{chat}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('collocutor_id, author_id', 'required'),
			array('owner_room, collocutor_id, author_id', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>7),
			array('chat_message, chat_created', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_chat, owner_room, collocutor_id, author_id, chat_message, chat_created, type', 'safe', 'on'=>'search'),
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
                    'collocutor'=>array(self::BELONGS_TO , 'User', 'collocutor_id'),
                    'users'=>array(self::BELONGS_TO, 'User', 'collocutor_id'),
                    'profile'=>array(self::HAS_ONE, 'TblUsersProfiles', array('id'=>'mid'), 'through'=>'users'),
                    'zip_n' => array(self::HAS_ONE, 'Zipcode', array('zipcode'=>'zip_id'), 'through'=>'profile' ),
                    'city_n' => array(self::HAS_ONE, 'City', array('cityid'=>'cityid'), 'through'=>'zip_n'),
                    'county_n' => array(self::HAS_ONE, 'County', array('county_id'=>'county_id'), 'through'=>'city_n' ),
                    'state_n' => array(self::HAS_ONE, 'State', array('state_id'=>'stid'), 'through'=>'county_n'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_chat' => 'Id Chat',
			'owner_room' => 'Owner Room',
			'collocutor_id' => 'Collocutor',
			'author_id' => 'Author',
			'chat_message' => 'Chat Message',
			'chat_created' => 'Chat Created',
			'type' => 'Type',
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

		$criteria->compare('id_chat',$this->id_chat);
		$criteria->compare('owner_room',$this->owner_room);
		$criteria->compare('collocutor_id',$this->collocutor_id);
		$criteria->compare('author_id',$this->author_id);
		$criteria->compare('chat_message',$this->chat_message,true);
		$criteria->compare('chat_created',$this->chat_created,true);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TblChat the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
