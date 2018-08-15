<?php

/**
 * This is the model class for table "agent_spy_clients_details".
 *
 * The followings are the available columns in table 'agent_spy_clients_details':
 * @property integer $agent_spy_id
 * @property string $page_visited
 * @property integer $spy_timestamp
 * @property string $listings_url
 */
class AgentSpyClientsDetails extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'agent_spy_clients_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('agent_spy_id, page_visited, spy_timestamp, listings_url', 'required'),
			array('agent_spy_id, spy_timestamp', 'numerical', 'integerOnly'=>true),
			array('page_visited', 'length', 'max'=>250),
			array('listings_url', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('agent_spy_id, page_visited, spy_timestamp, listings_url', 'safe', 'on'=>'search'),
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
			'page_visited' => 'Page Visited',
			'spy_timestamp' => 'Spy Timestamp',
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
		$criteria->compare('page_visited',$this->page_visited,true);
		$criteria->compare('spy_timestamp',$this->spy_timestamp);
		$criteria->compare('listings_url',$this->listings_url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AgentSpyClientsDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
