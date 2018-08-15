<?php

/**
 * This is the model class for table "agent_spy_clients".
 *
 * The followings are the available columns in table 'agent_spy_clients':
 * @property integer $agent_spy_id
 * @property integer $agent_mid
 * @property integer $viewer_mid
 * @property string $page_visited
 * @property integer $agent_spy_timestamp
 * @property integer $count_records
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $agent_subtype
 * @property string $listings_url
 */
class AgentSpyClients extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'agent_spy_clients';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('agent_mid, viewer_mid, page_visited, agent_spy_timestamp, count_records, first_name, last_name, phone, agent_subtype, listings_url', 'required'),
			array('agent_mid, viewer_mid, agent_spy_timestamp, count_records', 'numerical', 'integerOnly'=>true),
			array('page_visited', 'length', 'max'=>250),
			array('first_name, last_name, phone, agent_subtype', 'length', 'max'=>50),
			array('listings_url', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('agent_spy_id, agent_mid, viewer_mid, page_visited, agent_spy_timestamp, count_records, first_name, last_name, phone, agent_subtype, listings_url', 'safe', 'on'=>'search'),
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
			'agent_spy_id' => 'Agent Spy',
			'agent_mid' => 'Agent Mid',
			'viewer_mid' => 'Viewer Mid',
			'page_visited' => 'Page Visited',
			'agent_spy_timestamp' => 'Agent Spy Timestamp',
			'count_records' => 'Count Records',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'phone' => 'Phone',
			'agent_subtype' => 'Agent Subtype',
			'listings_url' => 'Listings Url',
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

		$criteria->compare('agent_spy_id',$this->agent_spy_id);
		$criteria->compare('agent_mid',$this->agent_mid);
		$criteria->compare('viewer_mid',$this->viewer_mid);
		$criteria->compare('page_visited',$this->page_visited,true);
		$criteria->compare('agent_spy_timestamp',$this->agent_spy_timestamp);
		$criteria->compare('count_records',$this->count_records);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('agent_subtype',$this->agent_subtype,true);
		$criteria->compare('listings_url',$this->listings_url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AgentSpyClients the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
