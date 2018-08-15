<?php

class m151126_152144_update_tbl_alerts_messages extends CDbMigration
{
	public function safeUp()
	{
		$this->getDbConnection()->createCommand("
									ALTER TABLE  `tbl_alerts_messages`
									ADD  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP AFTER `document`
								")->execute();
	}

	public function safeDown()
	{
		$this->dropColumn('{{tbl_alerts_messages}}', 'created_at');
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