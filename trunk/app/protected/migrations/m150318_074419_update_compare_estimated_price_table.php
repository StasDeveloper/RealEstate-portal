<?php

class m150318_074419_update_compare_estimated_price_table extends CDbMigration
{
	public function up()
	{
        $this->addColumn('compare_estimated_price_table','subdivision_comp',"tinyint(1) NOT NULL DEFAULT '0'");
        $this->dropColumn('compare_estimated_price_table','min_comp');
	}

	public function down()
	{
            $this->dropColumn('compare_estimated_price_table','subdivision_comp');
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