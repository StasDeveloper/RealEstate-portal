<?php

class m141030_124918_create_saved_search_emails_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_saved_search_emails', array(
            'id' => 'pk',
            'saved_search_id' => 'integer',
            'email' => 'string',
        ));
    }

    public function down()
    {
        $this->dropTable('tbl_saved_search_emails');
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