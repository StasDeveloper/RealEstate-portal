<?php

class m160601_094510_create_multiple_index_of_mls_comformity_history extends CDbMigration
{
	public function up()
	{
		$this->createIndex('mls_conformity', 'property_info_history', 'mls_sysid,mls_name', false);
	}

	public function down()
	{
		$this->dropIndex('mls_conformity', 'property_info_history');
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