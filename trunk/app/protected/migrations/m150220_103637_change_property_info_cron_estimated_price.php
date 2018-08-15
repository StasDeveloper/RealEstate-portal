<?php

class m150220_103637_change_property_info_cron_estimated_price extends CDbMigration
{
	public function up()
	{
            $this->addColumn('property_info_cron_estimated_price','created_at','TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
	}

	public function down()
	{
            $this->dropColumn('property_info_cron_estimated_price','created_at');
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