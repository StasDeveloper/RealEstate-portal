<?php

class m150204_084307_create_cron_market_info_city extends CDbMigration
{
    public function up()
    {
        $this->createTable('{{cron_market_info_city}}', array(
            'id' => 'pk',
            'city_id' => 'integer',
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
        $this->dropTable('{{cron_market_info_city}}');
    }
}