<?php

class m160729_085145_create_table_user_property_info extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_user_property_info', array(
			'id' => 'pk',
			'user_id' => 'INT NOT NULL',
			'property_id'=>'INT NOT NULL',
			'user_property_status' => 'string NOT NULL',
			'user_property_note' => 'string NULL',
			'create_date'=>'datetime NOT NULL',
			'last_changed_date'=>'datetime NOT NULL'
		));
	}

	public function down()
	{
		$this->dropTable('tbl_user_property_info');
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