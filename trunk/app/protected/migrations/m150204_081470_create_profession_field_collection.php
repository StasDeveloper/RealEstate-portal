<?php

class m150204_081470_create_profession_field_collection extends CDbMigration
{
    public function up()
    {
        $this->createTable('{{profession_field_collection}}', array(
            'id' => 'pk',
            'collection_id' => 'integer',
            'authitem_name' => 'string',
            'first_name' => 'string',
            'middle_name' => 'string',
            'last_name' => 'string',
            'office' => 'string',
            'street_address' => 'string',
            'address1' => 'string',
            'address2' => 'string',
            'state' => 'string',
            'county' => 'string',
            'city' => 'string',
            'zipcode' => 'string',
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
            'listing_type' => 'string',
            'payment_type' => 'string',
            'join_date' => 'string',
            'join_only_date' => 'string',
            'membership_expire_date' => 'string',
            'membership_subscription_date' => 'string',
            'audit_expire_date' => 'string',
            'profile_completion_percentage' => 'string',
            'rating_average' => 'string',
            'agent_last_login' => 'string',
            'agent_comments' => 'string',
            'profile_notification' => 'string',
            'website_notification' => 'string',
            'listings_notification' => 'string',
            'subscription' => 'string',
            'timestamp' => 'string',
        ));
    }

    public function down()
    {
        $this->dropTable('{{profession_field_collection}}');
    }
}