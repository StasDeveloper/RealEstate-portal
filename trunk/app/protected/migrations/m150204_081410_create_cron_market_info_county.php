<?php

class m150204_081410_create_cron_market_info_county extends CDbMigration
{
    public function up()
    {
        $this->createTable('{{cron_market_info_county}}', array(
            'id' => 'pk',
            'county_id' => 'integer',
            'date' => 'string',
            'total' => 'integer',
            'sale' => 'integer',
            'sold' => 'integer',
            'foreclosure' => 'integer',
            'short_sales' => 'integer',
            'avg_price' => 'double',
            'high_ppsf' => 'double',
            'low_ppsf' => 'double',
            'avg_ppsf' => 'double',
        ));
    }

    public function down()
    {
        $this->dropTable('{{cron_market_info_county}}');
    }
}