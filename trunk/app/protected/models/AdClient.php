<?php

/**
 * This is the model class for table "{{ad_client}}".
 *
 * The followings are the available columns in table '{{ad_client}}':
 * @property integer $id
 * @property integer $ad_category_id
 * @property string $company_name
 * @property string $rep_name
 * @property string $company_logo
 * @property string $company_address
 * @property string $company_website
 * @property string $contact_phone_number
 * @property string $alt_contact_phone_number
 * @property string $contact_email
 * @property string $alt_contact_email
 * @property string $ad_tag_line
 * @property string $ad_description
 * @property string $ad_confirmation_message
 * @property string $message_to_advertiser
 * @property string $updated_at
 * @property string $created_at
 * @property integer $status
 * @property integer $for_all
 *
 * The followings are the available model relations:
 * @property AdClientCategory $adCategory
 * @property AdClientCity[] $adClientCities
 * @property AdClientCounty[] $adClientCounties
 * @property AdClientState[] $adClientStates
 * @property AdClientZipcode[] $adClientZipcodes
 */
class AdClient extends CActiveRecord
{
    
    const INACTIVE=1;
    const ACTIVE=2;
    
    const AD_LIMIT=10;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ad_client}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_name, status, ad_tag_line', 'required'),
			array('ad_category_id, status, for_all', 'numerical', 'integerOnly'=>true),
			array('company_name, company_logo, company_address, company_website, ad_tag_line', 'length', 'max'=>255),
			array('rep_name, contact_email, alt_contact_email', 'length', 'max'=>128),
			array('contact_phone_number, alt_contact_phone_number', 'length', 'max'=>12),
			array('contact_email, alt_contact_email', 'email'),
                        array('company_website', 'url'),
			array('ad_description, ad_confirmation_message, message_to_advertiser, updated_at, created_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ad_category_id, company_name, rep_name, company_logo, company_address, company_website, contact_phone_number, alt_contact_phone_number, contact_email, alt_contact_email, ad_tag_line, ad_description, ad_confirmation_message, message_to_advertiser, updated_at, created_at, status, for_all', 'safe', 'on'=>'search'),
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
			'adCategory' => array(self::BELONGS_TO, 'AdClientCategory', 'ad_category_id'),
			'adClientCities' => array(self::HAS_MANY, 'AdClientCity', 'ad_client_id'),
			'adClientCounties' => array(self::HAS_MANY, 'AdClientCounty', 'ad_client_id'),
			'adClientStates' => array(self::HAS_MANY, 'AdClientState', 'ad_client_id'),
			'adClientZipcodes' => array(self::HAS_MANY, 'AdClientZipcode', 'ad_client_id'),
		);
	}

        public function behaviors() {
            return array(
                'CTimestampBehavior' => array(
                    'class' => 'zii.behaviors.CTimestampBehavior',
                    'createAttribute' => 'created_at',
                    'updateAttribute' => 'updated_at',
                )
            );
        }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ad_category_id' => 'Ad Category',
			'company_name' => 'Company Name',
			'rep_name' => 'Rep Name',
			'company_logo' => 'Company Logo',
			'company_address' => 'Company Address',
			'company_website' => 'Company Website',
			'contact_phone_number' => 'Contact Phone Number',
			'alt_contact_phone_number' => 'Alt Contact Phone Number',
			'contact_email' => 'Contact Email',
			'alt_contact_email' => 'Alt Contact Email',
			'ad_tag_line' => 'Ad Tag Line',
			'ad_description' => 'Ad Description',
			'ad_confirmation_message' => 'Ad Confirmation Message',
			'message_to_advertiser' => 'Message To Advertiser',
			'updated_at' => 'Updated At',
			'created_at' => 'Created At',
			'status' => 'Status',
			'for_all' => 'For All',
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
		$criteria->compare('ad_category_id',$this->ad_category_id);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('rep_name',$this->rep_name,true);
		$criteria->compare('company_logo',$this->company_logo,true);
		$criteria->compare('company_address',$this->company_address,true);
		$criteria->compare('company_website',$this->company_website,true);
		$criteria->compare('contact_phone_number',$this->contact_phone_number,true);
		$criteria->compare('alt_contact_phone_number',$this->alt_contact_phone_number,true);
		$criteria->compare('contact_email',$this->contact_email,true);
		$criteria->compare('alt_contact_email',$this->alt_contact_email,true);
		$criteria->compare('ad_tag_line',$this->ad_tag_line,true);
		$criteria->compare('ad_description',$this->ad_description,true);
		$criteria->compare('ad_confirmation_message',$this->ad_confirmation_message,true);
		$criteria->compare('message_to_advertiser',$this->message_to_advertiser,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('for_all',$this->for_all);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdClient the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function countSuggestToProperty(PropertyInfo $property) {
            return $this->count(array(
                'with'=>array(
                'adCategory',
                'adClientStates'=>array('select'=>false,),
                'adClientCounties'=>array('select'=>false,),
                'adClientCities'=>array('select'=>false,),
                'adClientZipcodes'=>array('select'=>false,),
                ),
                'condition'=>'t.`status`=:status AND ( `for_all`=1 OR adClientStates.ad_state_id=:ad_state_id OR adClientCounties.ad_county_id=:ad_county_id OR adClientCities.ad_city_id=:ad_city_id OR adClientZipcodes.ad_zipcode_id=:ad_zipcode_id ) ',
                'params'=>array(
                    ':status'=>  AdClient::ACTIVE,
                    ':ad_state_id'=>$property->property_state_id,
                    ':ad_county_id'=>$property->property_county_id,
                    ':ad_city_id'=>$property->property_city_id,
                    ':ad_zipcode_id'=>$property->property_zipcode,
                    ),
            ));
        }

        public function suggestToProperty(PropertyInfo $property) {
            return $this->findAll(array(
                'with'=>array(
                'adCategory',
                'adClientStates'=>array('select'=>false,),
                'adClientCounties'=>array('select'=>false,),
                'adClientCities'=>array('select'=>false,),
                'adClientZipcodes'=>array('select'=>false,),
                ),
                'condition'=>' (t.`status`=:status ) AND ( `for_all`=1 OR adClientStates.ad_state_id=:ad_state_id OR adClientCounties.ad_county_id=:ad_county_id OR adClientCities.ad_city_id=:ad_city_id OR adClientZipcodes.ad_zipcode_id=:ad_zipcode_id ) ',
                'params'=>array(
                    ':status'=>  AdClient::ACTIVE,
                    ':ad_state_id'=>$property->property_state_id,
                    ':ad_county_id'=>$property->property_county_id,
                    ':ad_city_id'=>$property->property_city_id,
                    ':ad_zipcode_id'=>$property->property_zipcode,
                    ),
                'order'=>'RAND()',
                'limit'=>  AdClient::AD_LIMIT,
                'together'=>true,
                'distinct'=>true,
            ));
        }
        
}
