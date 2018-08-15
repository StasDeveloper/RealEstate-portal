<?php

/**
 * This is the model class for table "mls_glvar_agent".
 *
 * The followings are the available columns in table 'mls_glvar_agent':
 * @property integer $id
 * @property string $t1660_address_line_1
 * @property string $t1661_work_phone
 * @property string $t1664_access_flag_l1_1000001
 * @property string $t1669_city
 * @property string $t1670_state
 * @property string $t1715_first_name
 * @property string $t1716_agent_phone
 * @property string $t1717_last_name
 * @property string $t1718_last_transaction_code
 * @property string $t1719_last_transaction_date
 * @property string $t1720_office_code
 * @property string $t1724_roster_flag_l1_397
 * @property string $t1727_public_id
 * @property string $t1730_zip_code
 * @property string $t2551_agentfullname
 */
class MlsGlvarAgent extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mls_glvar_agent';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('t1660_address_line_1, t1661_work_phone, t1664_access_flag_l1_1000001, t1669_city, t1670_state, t1715_first_name, t1716_agent_phone, t1717_last_name, t1718_last_transaction_code, t1719_last_transaction_date, t1720_office_code, t1724_roster_flag_l1_397, t1727_public_id, t1730_zip_code, t2551_agentfullname', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, t1660_address_line_1, t1661_work_phone, t1664_access_flag_l1_1000001, t1669_city, t1670_state, t1715_first_name, t1716_agent_phone, t1717_last_name, t1718_last_transaction_code, t1719_last_transaction_date, t1720_office_code, t1724_roster_flag_l1_397, t1727_public_id, t1730_zip_code, t2551_agentfullname', 'safe', 'on'=>'search'),
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
			't1660_address_line_1' => 'T1660 Address Line 1',
			't1661_work_phone' => 'T1661 Work Phone',
			't1664_access_flag_l1_1000001' => 'T1664 Access Flag L1 1000001',
			't1669_city' => 'T1669 City',
			't1670_state' => 'T1670 State',
			't1715_first_name' => 'T1715 First Name',
			't1716_agent_phone' => 'T1716 Agent Phone',
			't1717_last_name' => 'T1717 Last Name',
			't1718_last_transaction_code' => 'T1718 Last Transaction Code',
			't1719_last_transaction_date' => 'T1719 Last Transaction Date',
			't1720_office_code' => 'T1720 Office Code',
			't1724_roster_flag_l1_397' => 'T1724 Roster Flag L1 397',
			't1727_public_id' => 'T1727 Public',
			't1730_zip_code' => 'T1730 Zip Code',
			't2551_agentfullname' => 'T2551 Agentfullname',
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
		$criteria->compare('t1660_address_line_1',$this->t1660_address_line_1,true);
		$criteria->compare('t1661_work_phone',$this->t1661_work_phone,true);
		$criteria->compare('t1664_access_flag_l1_1000001',$this->t1664_access_flag_l1_1000001,true);
		$criteria->compare('t1669_city',$this->t1669_city,true);
		$criteria->compare('t1670_state',$this->t1670_state,true);
		$criteria->compare('t1715_first_name',$this->t1715_first_name,true);
		$criteria->compare('t1716_agent_phone',$this->t1716_agent_phone,true);
		$criteria->compare('t1717_last_name',$this->t1717_last_name,true);
		$criteria->compare('t1718_last_transaction_code',$this->t1718_last_transaction_code,true);
		$criteria->compare('t1719_last_transaction_date',$this->t1719_last_transaction_date,true);
		$criteria->compare('t1720_office_code',$this->t1720_office_code,true);
		$criteria->compare('t1724_roster_flag_l1_397',$this->t1724_roster_flag_l1_397,true);
		$criteria->compare('t1727_public_id',$this->t1727_public_id,true);
		$criteria->compare('t1730_zip_code',$this->t1730_zip_code,true);
		$criteria->compare('t2551_agentfullname',$this->t2551_agentfullname,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MlsGlvarAgent the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
