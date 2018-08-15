<?php

class m151203_134554_create_indexes_for_usrs_and_users_profiles extends CDbMigration
{
	public function safeUp()
	{
        Yii::app()->getDb()->createCommand()->createTable('{{tbl_users_profiles}}', array(
            'user_profile_id' => 'integer',
            'mid' => 'integer',
            'first_name' => 'string',
            'middle_name' => 'string',
            'last_name' => 'string',
            'office' => 'string',
            'street_address' => 'string',
            'street_number' => 'string',
            'address2' => 'string',
            'state' => 'string',
            'country' => 'string',
            'city' => 'string',
            'zipcode' => 'integer',
            'phone' => 'string',
            'phone_office' => 'string',
            'phone_fax' => 'string',
            'phone_home' => 'string',
            'phone_mobile' => 'string',
            'website_url' => 'string',
            'tagline' => 'string',
            'years_of_experience' => 'string',
            'years_of_experience_text' => 'string',
            'area_expertise' => 'string',
            'area_expertise_text' => 'string',
            'about_me' => 'string',
            'upload_photo' => 'string',
            'office_logo' => 'string',
            'upload_logo' => 'string',
            'listing_type' => 'integer',
            'payment_type' => 'integer',
            'join_date' => 'string',
            'join_only_date' => 'string',
            'membership_expire_date' => 'string',
            'membership_subscription_date' => 'string',
            'audit_expire_date' => 'string',
            'profile_completion_percentage' => 'integer',
            'rating_average' => 'double',
            'agent_last_login' => 'integer',
            'agent_comments' => 'string',
            'profile_notification' => 'string',
            'website_notification' => 'string',
            'listings_notification' => 'string',
            'subscription' => 'string',
            'timestamp' => 'DATETIME NULL DEFAULT NULL'
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');

        Yii::app()->db->schema->refresh();

        $this->createIndex('membership_expire_date', 'tbl_users_profiles', 'membership_expire_date', false);
        $this->createIndex('payment_type', 'tbl_users_profiles', 'payment_type', false);
	}

	public function safeDown()
	{
        $this->dropIndex('membership_expire_date', 'tbl_users_profiles');
        $this->dropIndex('payment_type', 'tbl_users_profiles');
	}

}