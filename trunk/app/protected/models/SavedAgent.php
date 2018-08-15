<?php

/**
 * This is the model class for table "saved_agent".
 *
 * The followings are the available columns in table 'saved_agent':
 * @property integer $saved_id
 * @property integer $agent_id
 * @property integer $mid
 * @property integer $saved_timestamp
 */
class SavedAgent extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'saved_agent';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('agent_id, mid, saved_timestamp', 'required'),
			array('agent_id, mid, saved_timestamp', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('saved_id, agent_id, mid, saved_timestamp', 'safe', 'on'=>'search'),
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
                    'saved_agent'=>array(self::BELONGS_TO, 'User', 'agent_id'),
                    'profile' => array(self::HAS_ONE, 'TblUsersProfiles', array('id'=>'mid'), 'through'=>'saved_agent'),
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
			'saved_id' => 'Saved',
			'agent_id' => 'Agent',
			'mid' => 'Mid',
			'saved_timestamp' => 'Saved Timestamp',
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

		$criteria->compare('saved_id',$this->saved_id);
		$criteria->compare('agent_id',$this->agent_id);
		$criteria->compare('mid',$this->mid);
		$criteria->compare('saved_timestamp',$this->saved_timestamp);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SavedAgent the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
