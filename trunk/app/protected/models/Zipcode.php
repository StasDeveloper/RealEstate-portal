<?php

/**
 * This is the model class for table "zipcode".
 *
 * The followings are the available columns in table 'zipcode':
 * @property integer $zip_id
 * @property integer $zip_code
 * @property string $latitude
 * @property string $longitude
 * @property integer $cityid
 */
class Zipcode extends CActiveRecord
{
	private static $_items=array();

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'zipcode';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('zip_code, cityid', 'numerical', 'integerOnly'=>true),
			array('latitude, longitude', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('zip_id, zip_code, latitude, longitude, cityid', 'safe', 'on'=>'search'),
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
                    'city' => array(self::BELONGS_TO, 'City', 'cityid'),
                    'county' => array(self::HAS_ONE, 'County', array('county_id'=>'county_id'), 'through'=>'city' ),
                    'state' => array(self::HAS_ONE, 'State', array('state_id'=>'stid'), 'through'=>'county'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'zip_id' => 'Zip',
			'zip_code' => 'Zip Code',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'cityid' => 'Cityid',
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

		$criteria->compare('zip_id',$this->zip_id);
		$criteria->compare('zip_code',$this->zip_code);
		$criteria->compare('latitude',$this->latitude,true);
		$criteria->compare('longitude',$this->longitude,true);
		$criteria->compare('cityid',$this->cityid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Zipcode the static model class
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
			self::$_items[$model->zip_id]=$model->zip_code;
	}
        
	/**
	 * Suggests a list of existing tags matching the specified keyword.
	 * @param string the keyword to be matched
	 * @param integer maximum number of tags to be returned
	 * @return array list of matching tag names
	 */
	public function suggestItems($keyword,$limit=20, $page = 1)
	{
		$tags=$this->findAll(array(
                        'with'=>array('city'),
			'condition'=>'zip_code LIKE :keyword',
			'order'=>'zip_code',
			'limit'=>$limit,
                        'offset'=>($page-1)*$limit,
			'params'=>array(
				':keyword'=>'%'.strtr($keyword,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%',
			),
		));
		$names=array();
		foreach($tags as $tag)
			$names[]=array('id'=> $tag->zip_id, 'name'=>$tag->zip_code . (!empty($tag->city)?' (' . $tag->city->city_name . ')':''));
		return $names;
	}
        
	/**
	 * Suggests a list of existing tags matching the specified keyword.
	 * @param string the keyword to be matched
	 * @param integer maximum number of tags to be returned
	 * @return array list of matching tag names
	 */
	public function countSuggestItems($keyword)
	{
		$tags=$this->count(array(
			'condition'=>'zip_code LIKE :keyword',
			'params'=>array(
				':keyword'=>'%'.strtr($keyword,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%',
			),
		));
		return $tags;
	}
}
