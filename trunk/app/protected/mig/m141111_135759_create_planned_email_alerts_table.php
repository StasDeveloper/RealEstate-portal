<?php

class m141111_135759_create_planned_email_alerts_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_planned_email_alerts', array(
            'id' => 'pk',
            'saved_search_id' => 'integer',
            'property_id' => 'integer',
            'email_freq' => 'integer',
        ));
    }

    public function down()
    {
        $this->dropTable('tbl_planned_email_alerts');
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