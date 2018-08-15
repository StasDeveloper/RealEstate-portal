<?php

class m141029_150838_create_saved_searches_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('tbl_saved_searches', array(
            'id' => 'pk',
            'user_id' => 'string NOT NULL',
            'name' => 'string',
            'email_alert_freq' => 'integer',
            'expiry_date' => 'DATETIME NULL DEFAULT NULL',
            'updated_at' => 'DATETIME NULL DEFAULT NULL',
            'created_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
        ));
	}

	public function down()
	{
        $this->dropTable('tbl_saved_searches');
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