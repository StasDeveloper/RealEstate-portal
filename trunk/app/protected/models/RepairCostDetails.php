<?php

/**
 * This is the model class for table "repair_cost_details".
 *
 * The followings are the available columns in table 'repair_cost_details':
 * @property integer $repair_cost_id
 * @property integer $repair_cost_title_id
 * @property string $repair_cost_detail_title
 * @property double $repair_cost
 */
class RepairCostDetails extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'repair_cost_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('repair_cost_title_id, repair_cost_detail_title, repair_cost', 'required'),
			array('repair_cost_title_id', 'numerical', 'integerOnly'=>true),
			array('repair_cost', 'numerical'),
			array('repair_cost_detail_title', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('repair_cost_id, repair_cost_title_id, repair_cost_detail_title, repair_cost', 'safe', 'on'=>'search'),
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
			'repair_cost_id' => 'Repair Cost',
			'repair_cost_title_id' => 'Repair Cost Title',
			'repair_cost_detail_title' => 'Repair Cost Detail Title',
			'repair_cost' => 'Repair Cost',
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

		$criteria->compare('repair_cost_id',$this->repair_cost_id);
		$criteria->compare('repair_cost_title_id',$this->repair_cost_title_id);
		$criteria->compare('repair_cost_detail_title',$this->repair_cost_detail_title,true);
		$criteria->compare('repair_cost',$this->repair_cost);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RepairCostDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
