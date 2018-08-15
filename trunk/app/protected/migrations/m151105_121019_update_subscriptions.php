<?php

class m151105_121019_update_subscriptions extends CDbMigration
{
	public function safeUp()
	{
		$this->getDbConnection()->createCommand("
ALTER TABLE  `subscriptions`
    ADD  `trans_id` INTEGER AFTER `user_id`
                ")->execute();

		$this->createIndex('trans_id', '{{subscriptions}}', 'trans_id', false);
		$this->addForeignKey('fk_subscriptions_trans_id', '{{subscriptions}}','trans_id', '{{subscription_transactions}}','id', 'RESTRICT', 'RESTRICT');

		// clear the cache schema of all loaded tables
		Yii::app()->db->schema->refresh();
	}

	public function safeDown()
	{
		echo "m151105_121019_update_subscriptions does not support migration down.\n";
		return false;
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