<?php

/**
 * This is the model class for table "mls_glvar_office".
 *
 * The followings are the available columns in table 'mls_glvar_office':
 * @property integer $id
 * @property string $t1608_city
 * @property string $t1609_state
 * @property string $t1647_city_and_state
 * @property string $t1652_office_code
 * @property string $t1653_office_name
 * @property string $t1654_office_phone
 * @property string $t1659_zip_code
 * @property string $t2217_designated_broker
 * @property string $t2533_designated_broker_name
 */
class MlsGlvarOffice extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mls_glvar_office';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('t1608_city, t1609_state, t1647_city_and_state, t1652_office_code, t1653_office_name, t1654_office_phone, t1659_zip_code, t2217_designated_broker, t2533_designated_broker_name', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, t1608_city, t1609_state, t1647_city_and_state, t1652_office_code, t1653_office_name, t1654_office_phone, t1659_zip_code, t2217_designated_broker, t2533_designated_broker_name', 'safe', 'on'=>'search'),
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
			't1608_city' => 'T1608 City',
			't1609_state' => 'T1609 State',
			't1647_city_and_state' => 'T1647 City And State',
			't1652_office_code' => 'T1652 Office Code',
			't1653_office_name' => 'T1653 Office Name',
			't1654_office_phone' => 'T1654 Office Phone',
			't1659_zip_code' => 'T1659 Zip Code',
			't2217_designated_broker' => 'T2217 Designated Broker',
			't2533_designated_broker_name' => 'T2533 Designated Broker Name',
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
		$criteria->compare('t1608_city',$this->t1608_city,true);
		$criteria->compare('t1609_state',$this->t1609_state,true);
		$criteria->compare('t1647_city_and_state',$this->t1647_city_and_state,true);
		$criteria->compare('t1652_office_code',$this->t1652_office_code,true);
		$criteria->compare('t1653_office_name',$this->t1653_office_name,true);
		$criteria->compare('t1654_office_phone',$this->t1654_office_phone,true);
		$criteria->compare('t1659_zip_code',$this->t1659_zip_code,true);
		$criteria->compare('t2217_designated_broker',$this->t2217_designated_broker,true);
		$criteria->compare('t2533_designated_broker_name',$this->t2533_designated_broker_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MlsGlvarOffice the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
