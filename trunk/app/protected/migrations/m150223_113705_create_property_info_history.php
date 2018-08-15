<?php

class m150223_113705_create_property_info_history extends CDbMigration
{
    public function up()
    {
        $this->createTable('{{property_info_history}}', array(
            'property_id' => 'integer',
            'year_biult_id' => 'integer',
            'pool' => 'integer',
            'garages' => 'integer',
            'mid' => 'integer',
            'property_title' => 'string',
            'house_square_footage' => 'integer',
            'lot_acreage' => 'double',
            'property_type' => 'integer',
            'property_price' => 'integer',
            'bathrooms' => 'integer',
            'bedrooms' => 'integer',
            'description' => 'string',
            'property_street' => 'string',
            'property_state_id' => 'integer',
            'property_county_id' => 'integer',
            'property_city_id' => 'integer',
            'property_zipcode' => 'integer',
            'property_uploaded_date' => 'string',
            'property_updated_date' => 'string',
            'property_expire_date' => 'string',
            'photo1' => 'string',
            'caption1' => 'string',
            'getlongitude' => 'double',
            'getlatitude' => 'double',
            'estimated_price' => 'integer',
            'percentage_depreciation_value' => 'integer',
            'property_status' => 'string',
            'user_session_id' => 'string',
            'visible' => 'string',
            'sub_type' => 'string',
            'area' => 'string',
            'subdivision' => 'string',
            'schools' => 'string',
            'community_name' => 'string',
            'community_features' => 'string',
            'property_fetatures' => 'string',
            'mls_sysid' => 'integer',
        ));
    }

    public function down()
    {
        $this->dropTable('{{property_info_history}}');
    }
}