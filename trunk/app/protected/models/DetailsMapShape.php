<?php

/**
 * This is the model class for table "{{details_map_shapes}}".
 *
 * The followings are the available columns in table '{{details_map_shapes}}':
 * @property integer $id
 * @property string $session_id
 * @property integer $prop_id
 * @property string $shape
 * @property string $excluded_props_by_shape
 * @property string $created_at
 */
class DetailsMapShape extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{details_map_shapes}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('session_id, prop_id', 'required'),
			array('prop_id', 'numerical', 'integerOnly'=>true),
			array('session_id', 'length', 'max'=>50),
			array('shape, excluded_props_by_shape, created_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, session_id, prop_id, shape, excluded_props_by_shape, created_at', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'session_id' => 'Session',
			'prop_id' => 'Prop',
			'shape' => 'Shape',
			'excluded_props_by_shape' => 'Excluded Props By Shape',
			'created_at' => 'Created At',
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
		$criteria->compare('session_id',$this->session_id,true);
		$criteria->compare('prop_id',$this->prop_id);
		$criteria->compare('shape',$this->shape,true);
		$criteria->compare('excluded_props_by_shape',$this->excluded_props_by_shape,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DetailsMapShape the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeSave() {
		if ($this->isNewRecord) {
			$this->created_at = new CDbExpression('NOW()');
		}

		/*
		$timest = time() - (10 * 24 * 60 * 60);
		$criteria = new CDbCriteria();
		$criteria->condition = "{$timest} > UNIX_TIMESTAMP('created_at')";
		$old_items = DetailsMapShape::model()->deleteAll($criteria);
		*/

		return parent::beforeSave();
	}
}
