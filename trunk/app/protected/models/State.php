<?php

/**
 * This is the model class for table "state".
 *
 * The followings are the available columns in table 'state':
 * @property integer $stid
 * @property string $state_name
 * @property string $state_code
 * @property integer $country_id
 */
class State extends CActiveRecord
{
    
	private static $_items=array();

        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'state';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('country_id', 'numerical', 'integerOnly'=>true),
			array('state_name', 'length', 'max'=>80),
			array('state_code', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('stid, state_name, state_code, country_id', 'safe', 'on'=>'search'),
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
                    'county' => array(self::HAS_MANY, 'County', 'state_id'),
                    'city' => array(self::HAS_MANY, 'City', array('county_id'=>'county_id'), 'through'=> 'county'),
                    'zipcode' => array(self::HAS_MANY, 'Zipcode', array(), 'through'=> '')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'stid' => 'Stid',
			'state_name' => 'State Name',
			'state_code' => 'State Code',
			'country_id' => 'Country',
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

		$criteria->compare('stid',$this->stid);
		$criteria->compare('state_name',$this->state_name,true);
		$criteria->compare('state_code',$this->state_code,true);
		$criteria->compare('country_id',$this->country_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return State the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
	/**
	 * Returns the items for the specified country_id.
	 * @param string item country_id (e.g. 'PostStatus').
	 * @return array item names indexed by item code. The items are order by their position values.
	 * An empty array is returned if the item country_id does not exist.
	 */
	public static function items($country_id)
	{
		if(!isset(self::$_items[$country_id]))
			self::loadItems($country_id);
		return self::$_items[$country_id];
	}

	/**
	 * Returns the item name for the specified country_id and code.
	 * @param string the item country_id (e.g. 'PostStatus').
	 * @param integer the item code (corresponding to the 'code' column value)
	 * @return string the item name for the specified the code. False is returned if the item country_id or code does not exist.
	 */
	public static function item($country_id,$code)
	{
		if(!isset(self::$_items[$country_id]))
			self::loadItems($country_id);
		return isset(self::$_items[$country_id][$code]) ? self::$_items[$country_id][$code] : false;
	}

	/**
	 * Loads the lookup items for the specified country_id from the database.
	 * @param string the item country_id
	 */
	private static function loadItems($country_id)
	{
		self::$_items[$country_id]=array();
		$models=self::model()->findAll(array(
			'condition'=>'country_id=:country_id',
			'params'=>array(':country_id'=>$country_id),
			'order'=>'state_code',
		));
		foreach($models as $model)
			self::$_items[$country_id][$model->stid]=$model->state_code;
	}
}
