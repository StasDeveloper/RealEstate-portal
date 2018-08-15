<?php

class m150223_113705_create_property_info_details_history extends CDbMigration
{
    public function up()
    {
        $this->createTable('{{property_info_details_history}}', array(
            'property_detail_id' => 'integer',
            'property_id' => 'integer',
            'stories' => 'string',
            'spa' => 'integer',
            'apt_suite' => 'string',
            'amenities_stove_id' => 'integer',
            'amenities_refrigerator' => 'integer',
            'amenities_dishwasher' => 'integer',
            'amenities_washer_id' => 'integer',
            'amenities_fireplace_id' => 'integer',
            'amenities_parking_id' => 'integer',
            'amenities_microwave' => 'integer',
            'amenities_gated_community' => 'integer',
            'photo2' => 'string',
            'caption2' => 'string',
            'photo3' => 'string',
            'caption3' => 'string',
            'photo4' => 'string',
            'caption4' => 'string',
            'photo5' => 'string',
            'caption5' => 'string',
            'interior_features' => 'string',
            'exterior_features' => 'string',
            'first_sale_type' => 'integer',
            'second_sale_type' => 'integer',
            'property_repair_price' => 'double',
            'reference' => 'string',
        ));
    }

    public function down()
    {
        $this->dropTable('{{property_info_details_history}}');
    }
}