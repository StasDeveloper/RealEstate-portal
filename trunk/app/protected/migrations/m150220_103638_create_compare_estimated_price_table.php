<?php

class m150220_103638_create_compare_estimated_price_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('{{compare_estimated_price_table}}', array(
            'compare_estimate_id' => 'integer',
            'property_type' => 'integer',
            'stage' => 'integer',
            'year_estimated' => 'string',
            'lot_estimated' => 'string',
            'house_estimated' => 'string',
            'lot_weighted' => 'string',
            'house_weighted' => 'string',
            'amenties_weighted' => 'string',
            'distance' => 'string',
//            'beds_estimated' => 'integer',
//            'baths_estimated' => 'integer',
//            'subdivision_comp' => 'integer',
            'min_comp' => 'integer',
            'house_views_comp' => 'integer',
        ));
    }

    public function down()
    {
        $this->dropTable('{{compare_estimated_price_table}}');
    }
}