<?php

class m150310_080109_update_compare_estimated_price_table extends CDbMigration
{
	public function up()
	{
            $this->addColumn('compare_estimated_price_table','beds_estimated',"tinyint(3) NOT NULL DEFAULT '0'");
            $this->addColumn('compare_estimated_price_table','baths_estimated',"tinyint(3) NOT NULL DEFAULT '0'");
	}

	public function down()
	{
            $this->dropColumn('compare_estimated_price_table','beds_estimated');
            $this->dropColumn('compare_estimated_price_table','baths_estimated');
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