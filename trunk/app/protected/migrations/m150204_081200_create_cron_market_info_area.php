<?php

class m150204_081200_create_cron_market_info_area extends CDbMigration
{
    public function up()
    {
        $this->createTable('{{cron_market_info_area}}', array(
            'id' => 'pk',
            'area' => 'string',
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
        $this->dropTable('{{cron_market_info_area}}');
    }


}