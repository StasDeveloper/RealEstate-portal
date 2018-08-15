<?php

/**
 * This is the model class for table "property_info_additional_brokerage_details_history".
 *
 * The followings are the available columns in table 'property_info_additional_brokerage_details_history':
 * @property integer $property_info_brokerage_details
 * @property integer $property_id
 * @property string $status
 * @property string $fireplace_features
 * @property string $heating_features
 * @property string $exterior_construction_features
 * @property string $roofing_features
 * @property string $interior_features
 * @property string $exterior_features
 * @property string $sales_history
 * @property string $tax_history
 * @property string $foreclosure
 * @property string $short_sale
 * @property string $page_link
 * @property string $updated_mid
 * @property integer $brokerage_mid
 * @property string $mls_id
 * @property string $pagent_name
 * @property string $pagent_phone
 * @property string $pagent_phone_fax
 * @property string $pagent_phone_home
 * @property string $pagent_phone_mobile
 * @property string $pagent_website
 */
class PropertyInfoAdditionalBrokerageDetailsHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'property_info_additional_brokerage_details_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('property_id, status, fireplace_features, heating_features, exterior_construction_features, roofing_features, interior_features, exterior_features, sales_history, tax_history, foreclosure, short_sale, page_link, updated_mid, brokerage_mid, mls_id, pagent_name, pagent_phone, pagent_phone_fax, pagent_phone_home, pagent_phone_mobile, pagent_website', 'required'),
			array('property_id, brokerage_mid', 'numerical', 'integerOnly'=>true),
			array('status, sales_history, tax_history', 'length', 'max'=>50),
			array('fireplace_features, heating_features, exterior_construction_features, roofing_features, interior_features, exterior_features', 'length', 'max'=>250),
			array('foreclosure, short_sale', 'length', 'max'=>15),
			array('page_link, pagent_website', 'length', 'max'=>150),
			array('updated_mid', 'length', 'max'=>1),
			array('mls_id, pagent_phone_fax, pagent_phone_home, pagent_phone_mobile', 'length', 'max'=>30),
			array('pagent_name', 'length', 'max'=>100),
			array('pagent_phone', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('property_info_brokerage_details, property_id, status, fireplace_features, heating_features, exterior_construction_features, roofing_features, interior_features, exterior_features, sales_history, tax_history, foreclosure, short_sale, page_link, updated_mid, brokerage_mid, mls_id, pagent_name, pagent_phone, pagent_phone_fax, pagent_phone_home, pagent_phone_mobile, pagent_website', 'safe', 'on'=>'search'),
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
                    'property_info'=> array(self::BELONGS_TO, 'PropertyInfo', 'property_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'property_info_brokerage_details' => 'Property Info Brokerage Details',
			'property_id' => 'Property',
			'status' => 'Status',
			'fireplace_features' => 'Fireplace Features',
			'heating_features' => 'Heating Features',
			'exterior_construction_features' => 'Exterior Construction Features',
			'roofing_features' => 'Roofing Features',
			'interior_features' => 'Interior Features',
			'exterior_features' => 'Exterior Features',
			'sales_history' => 'Sales History',
			'tax_history' => 'Tax History',
			'foreclosure' => 'Foreclosure',
			'short_sale' => 'Short Sale',
			'page_link' => 'Page Link',
			'updated_mid' => 'Updated Mid',
			'brokerage_mid' => 'Brokerage Mid',
			'mls_id' => 'Mls',
			'pagent_name' => 'Pagent Name',
			'pagent_phone' => 'Pagent Phone',
			'pagent_phone_fax' => 'Pagent Phone Fax',
			'pagent_phone_home' => 'Pagent Phone Home',
			'pagent_phone_mobile' => 'Pagent Phone Mobile',
			'pagent_website' => 'Pagent Website',
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

		$criteria->compare('property_info_brokerage_details',$this->property_info_brokerage_details);
		$criteria->compare('property_id',$this->property_id);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('fireplace_features',$this->fireplace_features,true);
		$criteria->compare('heating_features',$this->heating_features,true);
		$criteria->compare('exterior_construction_features',$this->exterior_construction_features,true);
		$criteria->compare('roofing_features',$this->roofing_features,true);
		$criteria->compare('interior_features',$this->interior_features,true);
		$criteria->compare('exterior_features',$this->exterior_features,true);
		$criteria->compare('sales_history',$this->sales_history,true);
		$criteria->compare('tax_history',$this->tax_history,true);
		$criteria->compare('foreclosure',$this->foreclosure,true);
		$criteria->compare('short_sale',$this->short_sale,true);
		$criteria->compare('page_link',$this->page_link,true);
		$criteria->compare('updated_mid',$this->updated_mid,true);
		$criteria->compare('brokerage_mid',$this->brokerage_mid);
		$criteria->compare('mls_id',$this->mls_id,true);
		$criteria->compare('pagent_name',$this->pagent_name,true);
		$criteria->compare('pagent_phone',$this->pagent_phone,true);
		$criteria->compare('pagent_phone_fax',$this->pagent_phone_fax,true);
		$criteria->compare('pagent_phone_home',$this->pagent_phone_home,true);
		$criteria->compare('pagent_phone_mobile',$this->pagent_phone_mobile,true);
		$criteria->compare('pagent_website',$this->pagent_website,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PropertyInfoAdditionalBrokerageDetailsHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
