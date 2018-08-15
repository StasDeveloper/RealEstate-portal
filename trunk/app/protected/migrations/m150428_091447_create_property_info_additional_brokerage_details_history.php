<?php

class m150428_091447_create_property_info_additional_brokerage_details_history extends CDbMigration
{

    public function up()
    {
        $this->createTable('{{property_info_additional_brokerage_details_history}}', [
            'property_info_brokerage_details' => 'integer',
            'property_id' => 'integer',
            'status' => 'string',
            'fireplace_features' => 'string',
            'heating_features' => 'string',
            'exterior_construction_features' => 'string',
            'roofing_features' => 'string',
            'interior_features' => 'string',
            'exterior_features' => 'string',
            'sales_history' => 'string',
            'tax_history' => 'string',
            'foreclosure' => 'string',
            'short_sale' => 'string',
            'page_link' => 'string',
            'updated_mid' => 'string',
            'brokerage_mid' => 'integer',
            'mls_id' => 'string',
            'pagent_name' => 'string',
            'pagent_phone' => 'string',
            'pagent_phone_fax' => 'string',
            'pagent_phone_home' => 'string',
            'pagent_phone_mobile' => 'string',
            'pagent_website' => 'string',
            ]);
    }

    public function down()
    {
        $this->dropTable('property_info_additional_brokerage_details_history');
    }

}