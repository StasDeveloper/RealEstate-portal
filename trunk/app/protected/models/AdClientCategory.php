<?php

/**
 * This is the model class for table "{{ad_client_category}}".
 *
 * The followings are the available columns in table '{{ad_client_category}}':
 * @property integer $id
 * @property string $ad_category
 *
 * The followings are the available model relations:
 * @property AdClient[] $adClients
 */
class AdClientCategory extends CActiveRecord
{
	private static $_items=array();

        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ad_client_category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ad_category', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ad_category', 'safe', 'on'=>'search'),
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
			'adClients' => array(self::HAS_MANY, 'AdClient', 'ad_category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ad_category' => 'Ad Category',
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
		$criteria->compare('ad_category',$this->ad_category,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdClientCategory the static model class
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
			self::$_items[$model->id]=$model->ad_category;
	}
}
