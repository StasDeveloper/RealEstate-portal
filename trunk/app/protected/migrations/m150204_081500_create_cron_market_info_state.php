<?php

class m150204_081500_create_cron_market_info_state extends CDbMigration
{
    public function up()
    {
        $this->createTable('{{cron_market_info_state}}', array(
            'id' => 'pk',
            'state_id' => 'integer',
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
        $this->dropTable('{{cron_market_info_state}}');
    }
}