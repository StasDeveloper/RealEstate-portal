<?php

/**
 * This is the model class for table "agent_join".
 *
 * The followings are the available columns in table 'agent_join':
 * @property integer $agent_id
 * @property integer $mid
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $office
 * @property string $address1
 * @property string $address2
 * @property integer $zipcode
 * @property string $phone
 * @property string $pagent_phone_fax
 * @property string $pagent_phone_home
 * @property string $pagent_phone_mobile
 * @property string $website_url
 * @property string $tagline
 * @property string $years_of_experience
 * @property string $years_of_experience_text
 * @property string $area_expertise
 * @property string $area_expertise_text
 * @property string $i_am_an
 * @property string $about_me
 * @property string $upload_photo
 * @property string $office_logo
 * @property string $upload_logo
 * @property integer $listing_type
 * @property integer $payment_type
 * @property string $membership_expire_date
 * @property integer $profile_completion_percentage
 * @property double $rating_average
 * @property integer $agent_last_login
 * @property string $agent_comments
 * @property string $profile_notification
 * @property string $website_notification
 * @property string $listings_notification
 */
class AgentJoin extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'agent_join';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pagent_phone_fax, pagent_phone_home, pagent_phone_mobile, tagline, years_of_experience, years_of_experience_text, area_expertise, area_expertise_text, i_am_an, about_me, office_logo, upload_logo, listing_type, payment_type, membership_expire_date, profile_completion_percentage, rating_average, agent_last_login, agent_comments, website_notification, listings_notification', 'required'),
			array('mid, zipcode, listing_type, payment_type, profile_completion_percentage, agent_last_login', 'numerical', 'integerOnly'=>true),
			array('rating_average', 'numerical'),
			array('first_name, middle_name, last_name, tagline, upload_photo', 'length', 'max'=>50),
			array('office', 'length', 'max'=>80),
			array('address1, address2', 'length', 'max'=>100),
			array('phone', 'length', 'max'=>20),
			array('pagent_phone_fax, pagent_phone_home, pagent_phone_mobile, area_expertise', 'length', 'max'=>30),
			array('website_url', 'length', 'max'=>130),
			array('years_of_experience', 'length', 'max'=>10),
			array('years_of_experience_text, area_expertise_text', 'length', 'max'=>150),
			array('i_am_an', 'length', 'max'=>25),
			array('office_logo, upload_logo', 'length', 'max'=>255),
			array('agent_comments', 'length', 'max'=>200),
			array('profile_notification, website_notification, listings_notification', 'length', 'max'=>3),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('agent_id, mid, first_name, middle_name, last_name, office, address1, address2, zipcode, phone, pagent_phone_fax, pagent_phone_home, pagent_phone_mobile, website_url, tagline, years_of_experience, years_of_experience_text, area_expertise, area_expertise_text, i_am_an, about_me, upload_photo, office_logo, upload_logo, listing_type, payment_type, membership_expire_date, profile_completion_percentage, rating_average, agent_last_login, agent_comments, profile_notification, website_notification, listings_notification', 'safe', 'on'=>'search'),
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
			'agent_id' => 'Agent',
			'mid' => 'Mid',
			'first_name' => 'First Name',
			'middle_name' => 'Middle Name',
			'last_name' => 'Last Name',
			'office' => 'Office',
			'address1' => 'Address1',
			'address2' => 'Address2',
			'zipcode' => 'Zipcode',
			'phone' => 'Phone',
			'pagent_phone_fax' => 'Pagent Phone Fax',
			'pagent_phone_home' => 'Pagent Phone Home',
			'pagent_phone_mobile' => 'Pagent Phone Mobile',
			'website_url' => 'Website Url',
			'tagline' => 'Tagline',
			'years_of_experience' => 'Years Of Experience',
			'years_of_experience_text' => 'Years Of Experience Text',
			'area_expertise' => 'Area Expertise',
			'area_expertise_text' => 'Area Expertise Text',
			'i_am_an' => 'I Am An',
			'about_me' => 'About Me',
			'upload_photo' => 'Upload Photo',
			'office_logo' => 'Office Logo',
			'upload_logo' => 'Upload Logo',
			'listing_type' => 'Listing Type',
			'payment_type' => 'Payment Type',
			'membership_expire_date' => 'Membership Expire Date',
			'profile_completion_percentage' => 'Profile Completion Percentage',
			'rating_average' => 'Rating Average',
			'agent_last_login' => 'Agent Last Login',
			'agent_comments' => 'Agent Comments',
			'profile_notification' => 'Profile Notification',
			'website_notification' => 'Website Notification',
			'listings_notification' => 'Listings Notification',
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

		$criteria->compare('agent_id',$this->agent_id);
		$criteria->compare('mid',$this->mid);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('office',$this->office,true);
		$criteria->compare('address1',$this->address1,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('zipcode',$this->zipcode);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('pagent_phone_fax',$this->pagent_phone_fax,true);
		$criteria->compare('pagent_phone_home',$this->pagent_phone_home,true);
		$criteria->compare('pagent_phone_mobile',$this->pagent_phone_mobile,true);
		$criteria->compare('website_url',$this->website_url,true);
		$criteria->compare('tagline',$this->tagline,true);
		$criteria->compare('years_of_experience',$this->years_of_experience,true);
		$criteria->compare('years_of_experience_text',$this->years_of_experience_text,true);
		$criteria->compare('area_expertise',$this->area_expertise,true);
		$criteria->compare('area_expertise_text',$this->area_expertise_text,true);
		$criteria->compare('i_am_an',$this->i_am_an,true);
		$criteria->compare('about_me',$this->about_me,true);
		$criteria->compare('upload_photo',$this->upload_photo,true);
		$criteria->compare('office_logo',$this->office_logo,true);
		$criteria->compare('upload_logo',$this->upload_logo,true);
		$criteria->compare('listing_type',$this->listing_type);
		$criteria->compare('payment_type',$this->payment_type);
		$criteria->compare('membership_expire_date',$this->membership_expire_date,true);
		$criteria->compare('profile_completion_percentage',$this->profile_completion_percentage);
		$criteria->compare('rating_average',$this->rating_average);
		$criteria->compare('agent_last_login',$this->agent_last_login);
		$criteria->compare('agent_comments',$this->agent_comments,true);
		$criteria->compare('profile_notification',$this->profile_notification,true);
		$criteria->compare('website_notification',$this->website_notification,true);
		$criteria->compare('listings_notification',$this->listings_notification,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AgentJoin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
