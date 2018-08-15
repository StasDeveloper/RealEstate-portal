<?php

class m141029_151457_create_saved_search_criteria_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('tbl_saved_search_criteria', array(
            'id' => 'pk',
            'saved_search_id' => 'integer',
            'attr_name' => 'string',
            'attr_value' => 'text',
            'updated_at' => 'DATETIME NULL DEFAULT NULL',
            'created_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
        ));
	}

	public function down()
	{
        $this->dropTable('tbl_saved_search_criteria');
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