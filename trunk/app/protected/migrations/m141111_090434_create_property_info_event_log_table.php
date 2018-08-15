<?php

class m141111_090434_create_property_info_event_log_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_property_info_event_log', array(
            'id' => 'pk',
            'type' => 'integer',
            'property_id' => 'integer',
            'run_at' => 'datetime',
        ));
    }

    public function down()
    {
        $this->dropTable('tbl_property_info_event_log');
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