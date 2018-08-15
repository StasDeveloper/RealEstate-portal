<?php

class m160517_090602_create_multiple_index_of_mls_comformity extends CDbMigration
{
	public function up()
	{
		$this->createIndex('mls_conformity', 'property_info', 'mls_sysid,mls_name', false);
	}

	public function down()
	{
		$this->dropIndex('mls_conformity', 'property_info');
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