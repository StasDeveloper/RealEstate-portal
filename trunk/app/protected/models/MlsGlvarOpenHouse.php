<?php

/**
 * This is the model class for table "mls_glvar_open_house".
 *
 * The followings are the available columns in table 'mls_glvar_open_house':
 * @property integer $id
 * @property integer $t0_sysid
 * @property string $t2163_ml_num
 * @property string $t2166_list_office_code
 * @property string $t2167_property_type_l1_1
 * @property string $t2168_list_price
 * @property string $t2169_street_number
 * @property string $t2170_compass_point_l1_4
 * @property string $t2171_street_name
 * @property string $t2172_area_l1_5
 * @property string $t2173_address
 * @property string $t2174_list_agent_public_id
 * @property integer $t2175_bedrooms
 * @property string $t2176_zip_code
 * @property string $t2177_open_house_date
 * @property string $t2178_open_house_time
 * @property string $t2179_open_house_type_l1_1000007
 * @property string $t2180_open_house_status_l1_1000008
 * @property string $t2181_refreshments_lYESNO
 * @property string $t2182_open_house_remarks
 * @property string $t2183_open_house_directions
 * @property string $t2186_parcel_num
 * @property string $t2187_property_status_l1_338
 */
class MlsGlvarOpenHouse extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mls_glvar_open_house';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('t0_sysid, t2175_bedrooms', 'numerical', 'integerOnly'=>true),
			array('t2168_list_price', 'length', 'max'=>12),
			array('t2181_refreshments_lYESNO', 'length', 'max'=>3),
			array('t2163_ml_num, t2166_list_office_code, t2167_property_type_l1_1, t2169_street_number, t2170_compass_point_l1_4, t2171_street_name, t2172_area_l1_5, t2173_address, t2174_list_agent_public_id, t2176_zip_code, t2177_open_house_date, t2178_open_house_time, t2179_open_house_type_l1_1000007, t2180_open_house_status_l1_1000008, t2182_open_house_remarks, t2183_open_house_directions, t2186_parcel_num, t2187_property_status_l1_338', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, t0_sysid, t2163_ml_num, t2166_list_office_code, t2167_property_type_l1_1, t2168_list_price, t2169_street_number, t2170_compass_point_l1_4, t2171_street_name, t2172_area_l1_5, t2173_address, t2174_list_agent_public_id, t2175_bedrooms, t2176_zip_code, t2177_open_house_date, t2178_open_house_time, t2179_open_house_type_l1_1000007, t2180_open_house_status_l1_1000008, t2181_refreshments_lYESNO, t2182_open_house_remarks, t2183_open_house_directions, t2186_parcel_num, t2187_property_status_l1_338', 'safe', 'on'=>'search'),
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
			't0_sysid' => 'T0 Sysid',
			't2163_ml_num' => 'T2163 Ml Num',
			't2166_list_office_code' => 'T2166 List Office Code',
			't2167_property_type_l1_1' => 'T2167 Property Type L1 1',
			't2168_list_price' => 'T2168 List Price',
			't2169_street_number' => 'T2169 Street Number',
			't2170_compass_point_l1_4' => 'T2170 Compass Point L1 4',
			't2171_street_name' => 'T2171 Street Name',
			't2172_area_l1_5' => 'T2172 Area L1 5',
			't2173_address' => 'T2173 Address',
			't2174_list_agent_public_id' => 'T2174 List Agent Public',
			't2175_bedrooms' => 'T2175 Bedrooms',
			't2176_zip_code' => 'T2176 Zip Code',
			't2177_open_house_date' => 'T2177 Open House Date',
			't2178_open_house_time' => 'T2178 Open House Time',
			't2179_open_house_type_l1_1000007' => 'T2179 Open House Type L1 1000007',
			't2180_open_house_status_l1_1000008' => 'T2180 Open House Status L1 1000008',
			't2181_refreshments_lYESNO' => 'T2181 Refreshments L Yesno',
			't2182_open_house_remarks' => 'T2182 Open House Remarks',
			't2183_open_house_directions' => 'T2183 Open House Directions',
			't2186_parcel_num' => 'T2186 Parcel Num',
			't2187_property_status_l1_338' => 'T2187 Property Status L1 338',
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
		$criteria->compare('t0_sysid',$this->t0_sysid);
		$criteria->compare('t2163_ml_num',$this->t2163_ml_num,true);
		$criteria->compare('t2166_list_office_code',$this->t2166_list_office_code,true);
		$criteria->compare('t2167_property_type_l1_1',$this->t2167_property_type_l1_1,true);
		$criteria->compare('t2168_list_price',$this->t2168_list_price,true);
		$criteria->compare('t2169_street_number',$this->t2169_street_number,true);
		$criteria->compare('t2170_compass_point_l1_4',$this->t2170_compass_point_l1_4,true);
		$criteria->compare('t2171_street_name',$this->t2171_street_name,true);
		$criteria->compare('t2172_area_l1_5',$this->t2172_area_l1_5,true);
		$criteria->compare('t2173_address',$this->t2173_address,true);
		$criteria->compare('t2174_list_agent_public_id',$this->t2174_list_agent_public_id,true);
		$criteria->compare('t2175_bedrooms',$this->t2175_bedrooms);
		$criteria->compare('t2176_zip_code',$this->t2176_zip_code,true);
		$criteria->compare('t2177_open_house_date',$this->t2177_open_house_date,true);
		$criteria->compare('t2178_open_house_time',$this->t2178_open_house_time,true);
		$criteria->compare('t2179_open_house_type_l1_1000007',$this->t2179_open_house_type_l1_1000007,true);
		$criteria->compare('t2180_open_house_status_l1_1000008',$this->t2180_open_house_status_l1_1000008,true);
		$criteria->compare('t2181_refreshments_lYESNO',$this->t2181_refreshments_lYESNO,true);
		$criteria->compare('t2182_open_house_remarks',$this->t2182_open_house_remarks,true);
		$criteria->compare('t2183_open_house_directions',$this->t2183_open_house_directions,true);
		$criteria->compare('t2186_parcel_num',$this->t2186_parcel_num,true);
		$criteria->compare('t2187_property_status_l1_338',$this->t2187_property_status_l1_338,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MlsGlvarOpenHouse the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
