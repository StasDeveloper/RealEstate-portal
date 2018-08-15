<?php

/**
 * This is the model class for table "property_price_comp_tool".
 *
 * The followings are the available columns in table 'property_price_comp_tool':
 * @property integer $comp_tool_id
 * @property string $comp_tool_first_name
 * @property string $comp_tool_email
 * @property string $comp_tool_phone
 */
class PropertyPriceCompTool extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'property_price_comp_tool';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comp_tool_first_name, comp_tool_email, comp_tool_phone', 'required'),
			array('comp_tool_first_name', 'length', 'max'=>60),
			array('comp_tool_email', 'length', 'max'=>100),
			array('comp_tool_phone', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('comp_tool_id, comp_tool_first_name, comp_tool_email, comp_tool_phone', 'safe', 'on'=>'search'),
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
			'comp_tool_id' => 'Comp Tool',
			'comp_tool_first_name' => 'Comp Tool First Name',
			'comp_tool_email' => 'Comp Tool Email',
			'comp_tool_phone' => 'Comp Tool Phone',
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

		$criteria->compare('comp_tool_id',$this->comp_tool_id);
		$criteria->compare('comp_tool_first_name',$this->comp_tool_first_name,true);
		$criteria->compare('comp_tool_email',$this->comp_tool_email,true);
		$criteria->compare('comp_tool_phone',$this->comp_tool_phone,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PropertyPriceCompTool the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
