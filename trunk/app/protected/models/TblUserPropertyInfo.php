<?php

/**
 * This is the model class for table "{{user_property_info}}".
 *
 * The followings are the available columns in table '{{user_property_info}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $mls_sysid
 * @property string $mls_name
 * @property string $user_property_status
 * @property string $user_property_note
 * @property string $create_date
 * @property string $last_viewed_date
 * @property string $last_changed_date
 */
class TblUserPropertyInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_property_info}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, mls_sysid, mls_name, user_property_status, create_date, last_viewed_date, last_changed_date', 'required'),
			array('user_id, property_id, mls_sysid', 'numerical', 'integerOnly'=>true),
			array('user_property_status, user_property_note', 'length', 'max'=>255),
			array('mls_name', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, mls_sysid, mls_name, user_property_status, user_property_note, create_date, last_viewed_date, last_changed_date', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'mls_sysid' => 'Mls Sysid',
			'mls_name'=>'Mls Name',
			'user_property_status' => 'User Property Status',
			'user_property_note' => 'User Property Note',
			'create_date' => 'Create Date',
			'last_viewed_date' => 'Last Viewed Date',
			'last_changed_date' => 'Last Changed Date',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('mls_sysid',$this->mls_sysid);
		$criteria->compare('mls_name',$this->mls_name);
		$criteria->compare('user_property_status',$this->user_property_status,true);
		$criteria->compare('user_property_note',$this->user_property_note,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('last_viewed_date',$this->last_viewed_date,true);
		$criteria->compare('last_changed_date',$this->last_changed_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TblUserPropertyInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
