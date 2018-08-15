<?php

/**
 * This is the model class for table "{{users_profiles}}".
 *
 * The followings are the available columns in table '{{users_profiles}}':
 * @property integer $user_profile_id
 * @property integer $mid
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $office
 * @property string $street_address
 * @property string $street_number
 * @property string $address2
 * @property string $state
 * @property string $country
 * @property string $city
 * @property integer $zipcode
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
 * @property integer $listing_type
 * @property integer $payment_type
 * @property string $join_date
 * @property string $join_only_date
 * @property string $membership_expire_date
 * @property string $membership_subscription_date
 * @property string $audit_expire_date
 * @property integer $profile_completion_percentage
 * @property double $rating_average
 * @property integer $agent_last_login
 * @property string $agent_comments
 * @property string $profile_notification
 * @property string $website_notification
 * @property string $listings_notification
 * @property string $subscription
 * @property string $timestamp
 */
class TblUsersProfiles extends CActiveRecord
{
    public $id;
    public static $regMode = false;
    private static $_model;
    private static $_modelReg;
    private static $_rules = array();
    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{users_profiles}}';
    }

    public function getId(){
        return $this->user_profile_id;
    }
    

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('mid, zipcode, listing_type, payment_type, profile_completion_percentage, agent_last_login, timestamp', 'numerical', 'integerOnly'=>true),
            array('rating_average', 'numerical'),
            array('first_name, middle_name, last_name, tagline, upload_photo', 'length', 'max'=>50),
            array('office', 'length', 'max'=>80),
            array('street_address, address2', 'length', 'max'=>100),
            array('phone',  'length', 'max'=>20),
            array('phone_fax, phone_office, phone_home, phone_mobile, area_expertise', 'length', 'max'=>30),
            //array('phone, phone_office, phone_fax, phone_home, phone_mobile', 'match', 'pattern'=>'/^\([0-9]{3}\)[0-9]{3}-[0-9]{4}$/' , 'message'=>'Phone number must be input as follows (xxx)xxx-xxxx'),
            array('website_url', 'length', 'max'=>130),
            //array('website_url', 'url'),
            array( 'street_number, state, country, city',  'length', 'max'=>255),
            array('years_of_experience', 'length', 'max'=>10),
            array('years_of_experience_text, area_expertise_text', 'length', 'max'=>150),
            array('office_logo, upload_logo', 'length', 'max'=>255),
            array('agent_comments', 'length', 'max'=>200),
            array('profile_notification, website_notification, listings_notification, subscription', 'length', 'max'=>3),
            array('about_me, join_date, join_only_date, membership_expire_date, membership_subscription_date, audit_expire_date', 'safe'),
            array('upload_photo, office_logo, upload_logo','safe'),
            
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('user_profile_id, mid, first_name, middle_name, last_name, office, street_address, street_number, address2, state, country, city, zipcode, phone, phone_office, phone_fax, phone_home, phone_mobile, website_url, tagline, years_of_experience, years_of_experience_text, area_expertise, area_expertise_text, about_me, upload_photo, office_logo, upload_logo, listing_type, payment_type, join_date, join_only_date, membership_expire_date, membership_subscription_date, audit_expire_date, profile_completion_percentage, rating_average, agent_last_login, agent_comments, profile_notification, website_notification, listings_notification, subscription, timestamp, lastvisit', 'safe', 'on'=>'search'),
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
            'users'=>array(self::BELONGS_TO, 'User', 'mid'),
            'saved_agents'=>array(self::HAS_MANY, 'SavedAgent', 'agent_id'),
            'roles' => array(self::HAS_MANY, 'TblAuthAssignment', array('userid'=>'mid'), 'through'=>'users' ),
            
            'zip_n' => array(self::BELONGS_TO, 'Zipcode', 'zipcode' ),
            'city_n' => array(self::HAS_ONE, 'City', array('cityid'=>'cityid'), 'through'=>'zip_n'),
            'county_n' => array(self::HAS_ONE, 'County', array('county_id'=>'county_id'), 'through'=>'city_n' ),
            'state_n' => array(self::HAS_ONE, 'State', array('state_id'=>'stid'), 'through'=>'county_n'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'user_profile_id' => 'User Profile',
            'mid' => 'Mid',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'office' => 'Office',
            'street_address' => "Your business address, if you'd like one displayed on your public profile...",
            'street_number' => 'Street Number',
            'address2' => 'Address2',
            'state' => 'State', 
            'country' => 'Country', 
            'city' => 'City',
            'zipcode' => 'Zipcode',
            'phone' => 'Phone',
            'phone_office' => 'Office Phone',
            'phone_fax' => 'Pagent Phone Fax',
            'phone_home' => 'Pagent Phone Home',
            'phone_mobile' => 'Pagent Phone Mobile',
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
            'timestamp'=> 'Timestamp'
            
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

        $criteria->compare('user_profile_id',$this->user_profile_id);
        $criteria->compare('mid',$this->mid);
        $criteria->compare('first_name',$this->first_name,true);
        $criteria->compare('middle_name',$this->middle_name,true);
        $criteria->compare('last_name',$this->last_name,true);
        $criteria->compare('office',$this->office,true);
        $criteria->compare('street_address',$this->street_address,true);
        $criteria->compare('street_number',$this->street_number,true);
        $criteria->compare('address2',$this->address2,true);
        $criteria->compare('state',$this->state,true);
        $criteria->compare('country',$this->country,true);
        $criteria->compare('city',$this->city,true);
        $criteria->compare('zipcode',$this->zipcode);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('phone_office',$this->phone_office,true);
        $criteria->compare('phone_fax',$this->pagent_phone_fax,true);
        $criteria->compare('phone_home',$this->pagent_phone_home,true);
        $criteria->compare('phone_mobile',$this->pagent_phone_mobile,true);
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
        $criteria->compare('listing_type',$this->listing_type);
        $criteria->compare('payment_type',$this->payment_type);
        $criteria->compare('join_date',$this->join_date,true);
        $criteria->compare('join_only_date',$this->join_only_date,true);
        $criteria->compare('membership_expire_date',$this->membership_expire_date,true);
        $criteria->compare('membership_subscription_date',$this->membership_subscription_date,true);
        $criteria->compare('audit_expire_date',$this->audit_expire_date,true);
        $criteria->compare('profile_completion_percentage',$this->profile_completion_percentage);
        $criteria->compare('rating_average',$this->rating_average);
        $criteria->compare('agent_last_login',$this->agent_last_login);
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
     * @return TblUsersProfiles the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}