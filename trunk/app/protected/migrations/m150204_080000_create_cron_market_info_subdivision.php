<?php

class m150204_080000_create_cron_market_info_subdivision extends CDbMigration
{
    public function up()
    {
        $this->createTable('{{cron_market_info_subdivision}}', array(
            'id' => 'pk',
            'subdivision' => 'VARCHAR(64) NOT NULL',
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
        $this->createIndex('subdivision', '{{cron_market_info_subdivision}}', 'subdivision', false);
        $this->createIndex('date', '{{cron_market_info_subdivision}}', 'date', false);
    }

    public function down()
    {
        $this->dropTable('{{cron_market_info_subdivision}}');
    }


	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}