<?php

/**
 * This is the model class for table "county".
 *
 * The followings are the available columns in table 'county':
 * @property integer $county_id
 * @property string $county_name
 * @property string $state_id
 */
class County extends CActiveRecord
{
	private static $_items=array();

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'county';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('county_name', 'length', 'max'=>80),
			array('state_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('county_id, county_name, state_id', 'safe', 'on'=>'search'),
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
                    'city'  => array(self::HAS_MANY, 'City', 'county_id'),
                    'state' => array(self::BELONGS_TO, 'State', 'state_id'),
                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'county_id' => 'County',
			'county_name' => 'County Name',
			'state_id' => 'State',
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

		$criteria->compare('county_id',$this->county_id);
		$criteria->compare('county_name',$this->county_name,true);
		$criteria->compare('state_id',$this->state_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return County the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
	/**
	 * Returns the items for the specified type.
	 * @return array item names indexed by item code. The items are order by their position values.
	 * An empty array is returned if the item type does not exist.
	 */
	public static function items()
	{
		if(empty(self::$_items))
			self::loadItems();
		return self::$_items;
	}

	/**
	 * Returns the item name for the specified code.
	 * @param integer the item code (corresponding to the 'code' column value)
	 * @return string the item name for the specified the code. False is returned if the item type or code does not exist.
	 */
	public static function item($code)
	{
		if(empty(self::$_items))
			self::loadItems();
		return isset(self::$_items[$code]) ? self::$_items[$code] : false;
	}

	/**
	 * Loads the lookup items from the database.
	 * @param string the item type
	 */
	private static function loadItems()
	{
		self::$_items=array();
		$models=self::model()->findAll(
//                    array(
//			'condition'=>'type=:type',
//			'params'=>array(':type'=>$type),
//			'order'=>'position',
//                    )
                );
		foreach($models as $model)
			self::$_items[$model->county_id]=$model->county_name;
	}
}
