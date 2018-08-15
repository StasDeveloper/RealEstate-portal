<?php

class m150204_081000_create_cron_market_info_zipcode extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_cron_market_info_zipcode', array(
            'id' => 'pk',
            'zipcode_id' => 'integer',
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
        $this->dropTable('tbl_cron_market_info_zipcode');
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