<?php

/**
 * This is the model class for table "{{profession_field_collection}}".
 *
 * The followings are the available columns in table '{{profession_field_collection}}':
 * @property integer $collection_id
 * @property string $authitem_name
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $office
 * @property string $street_address
 * @property string $address1
 * @property string $address2
 * @property string $state
 * @property string $county
 * @property string $city
 * @property string $zipcode
 * @property string $phone
 * @property string $phone_office
 * @property string $phone_fax
 * @property string $phone_home
 * @property string $phone_mobile
 * @property string $website_url
 * @property string $tagline
 * @property string $years_of_experience
 * @property string $years_of_experience_text
 * @property string $area_expertise
 * @property string $area_expertise_text
 * @property string $about_me
 * @property string $upload_photo
 * @property string $office_logo
 * @property string $upload_logo
 * @property string $listing_type
 * @property string $payment_type
 * @property string $join_date
 * @property string $join_only_date
 * @property string $membership_expire_date
 * @property string $membership_subscription_date
 * @property string $audit_expire_date
 * @property string $profile_completion_percentage
 * @property string $rating_average
 * @property string $agent_last_login
 * @property string $agent_comments
 * @property string $profile_notification
 * @property string $website_notification
 * @property string $listings_notification
 * @property string $subscription
 * @property string $timestamp
 */
class TblProfessionFieldCollection extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{profession_field_collection}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('authitem_name', 'required'),
			array('authitem_name', 'length', 'max'=>100),
			array('first_name, middle_name, last_name, office, street_address, address1, address2, state, county, city, zipcode, phone, phone_office, phone_fax, phone_home, phone_mobile, website_url, tagline, years_of_experience, years_of_experience_text, area_expertise, area_expertise_text, about_me, upload_photo, office_logo, upload_logo, listing_type, payment_type, join_date, join_only_date, membership_expire_date, membership_subscription_date, audit_expire_date, profile_completion_percentage, rating_average, agent_last_login, agent_comments, profile_notification, website_notification, listings_notification, subscription, timestamp', 'length', 'max'=>3),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('collection_id, authitem_name, first_name, middle_name, last_name, office, street_address, address1, address2, state, county, city, zipcode, phone, phone_office, phone_fax, phone_home, phone_mobile, website_url, tagline, years_of_experience, years_of_experience_text, area_expertise, area_expertise_text, about_me, upload_photo, office_logo, upload_logo, listing_type, payment_type, join_date, join_only_date, membership_expire_date, membership_subscription_date, audit_expire_date, profile_completion_percentage, rating_average, agent_last_login, agent_comments, profile_notification, website_notification, listings_notification, subscription, timestamp', 'safe', 'on'=>'search'),
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
			'collection_id' => 'Collection',
			'authitem_name' => 'Authitem Name',
			'first_name' => 'First Name',
			'middle_name' => 'Middle Name',
			'last_name' => 'Last Name',
			'office' => 'Office',
			'street_address' => 'Street Address',
			'address1' => 'Address1',
			'address2' => 'Address2',
			'state' => 'State',
			'county' => 'County',
			'city' => 'City',
			'zipcode' => 'Zipcode',
			'phone' => 'Phone',
			'phone_office' => 'Phone Office',
			'phone_fax' => 'Phone Fax',
			'phone_home' => 'Phone Home',
			'phone_mobile' => 'Phone Mobile',
			'website_url' => 'Website Url',
			'tagline' => 'Tagline',
			'years_of_experience' => 'Years Of Experience',
			'years_of_experience_text' => 'Years Of Experience Text',
			'area_expertise' => 'Area Expertise',
			'area_expertise_text' => 'Area Expertise Text',
			'about_me' => 'About Me',
			'upload_photo' => 'Upload Photo',
			'office_logo' => 'Office Logo',
			'upload_logo' => 'Upload Logo',
			'listing_type' => 'Listing Type',
			'payment_type' => 'Payment Type',
			'join_date' => 'Join Date',
			'join_only_date' => 'Join Only Date',
			'membership_expire_date' => 'Membership Expire Date',
			'membership_subscription_date' => 'Membership Subscription Date',
			'audit_expire_date' => 'Audit Expire Date',
			'profile_completion_percentage' => 'Profile Completion Percentage',
			'rating_average' => 'Rating Average',
			'agent_last_login' => 'Agent Last Login',
			'agent_comments' => 'Agent Comments',
			'profile_notification' => 'Profile Notification',
			'website_notification' => 'Website Notification',
			'listings_notification' => 'Listings Notification',
			'subscription' => 'Subscription',
			'timestamp' => 'Timestamp',
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

		$criteria->compare('collection_id',$this->collection_id);
		$criteria->compare('authitem_name',$this->authitem_name,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('office',$this->office,true);
		$criteria->compare('street_address',$this->street_address,true);
		$criteria->compare('address1',$this->address1,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('county',$this->county,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('phone_office',$this->phone_office,true);
		$criteria->compare('phone_fax',$this->phone_fax,true);
		$criteria->compare('phone_home',$this->phone_home,true);
		$criteria->compare('phone_mobile',$this->phone_mobile,true);
		$criteria->compare('website_url',$this->website_url,true);
		$criteria->compare('tagline',$this->tagline,true);
		$criteria->compare('years_of_experience',$this->years_of_experience,true);
		$criteria->compare('years_of_experience_text',$this->years_of_experience_text,true);
		$criteria->compare('area_expertise',$this->area_expertise,true);
		$criteria->compare('area_expertise_text',$this->area_expertise_text,true);
		$criteria->compare('about_me',$this->about_me,true);
		$criteria->compare('upload_photo',$this->upload_photo,true);
		$criteria->compare('office_logo',$this->office_logo,true);
		$criteria->compare('upload_logo',$this->upload_logo,true);
		$criteria->compare('listing_type',$this->listing_type,true);
		$criteria->compare('payment_type',$this->payment_type,true);
		$criteria->compare('join_date',$this->join_date,true);
		$criteria->compare('join_only_date',$this->join_only_date,true);
		$criteria->compare('membership_expire_date',$this->membership_expire_date,true);
		$criteria->compare('membership_subscription_date',$this->membership_subscription_date,true);
		$criteria->compare('audit_expire_date',$this->audit_expire_date,true);
		$criteria->compare('profile_completion_percentage',$this->profile_completion_percentage,true);
		$criteria->compare('rating_average',$this->rating_average,true);
		$criteria->compare('agent_last_login',$this->agent_last_login,true);
		$criteria->compare('agent_comments',$this->agent_comments,true);
		$criteria->compare('profile_notification',$this->profile_notification,true);
		$criteria->compare('website_notification',$this->website_notification,true);
		$criteria->compare('listings_notification',$this->listings_notification,true);
		$criteria->compare('subscription',$this->subscription,true);
		$criteria->compare('timestamp',$this->timestamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TblProfessionFieldCollection the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
