<?php

class m150204_084308_create_index_cron_market_info extends CDbMigration
{
	public function up()
	{
//            $this->createIndex('zipcode_id', '{{cron_market_info_zipcode}}', 'zipcode_id', false);
//            $this->createIndex('date', '{{cron_market_info_zipcode}}', 'date', false);

            $this->alterColumn('{{cron_market_info_area}}', 'area', 'VARCHAR(64) NOT NULL');
            $this->createIndex('area', '{{cron_market_info_area}}', 'area', false);
            $this->createIndex('date', '{{cron_market_info_area}}', 'date', false);

            $this->createIndex('city_id', '{{cron_market_info_city}}', 'city_id', false);
            $this->createIndex('date', '{{cron_market_info_city}}', 'date', false);

            $this->createIndex('county_id', '{{cron_market_info_county}}', 'county_id', false);
            $this->createIndex('date', '{{cron_market_info_county}}', 'date', false);

            $this->createIndex('state_id', '{{cron_market_info_state}}', 'state_id', false);
            $this->createIndex('date', '{{cron_market_info_state}}', 'date', false);
        }

	public function down()
	{
		echo "m150204_084308_create_index_cron_market_info does not support migration down.\n";
		return false;
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