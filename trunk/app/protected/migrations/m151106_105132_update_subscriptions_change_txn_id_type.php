<?php

class m151106_105132_update_subscriptions_change_txn_id_type extends CDbMigration
{
	public function safeUp()
	{
		$this->dropForeignKey('fk_subscriptions_trans_id', '{{subscriptions}}');
		$this->dropIndex('trans_id', '{{subscriptions}}');
		$this->dropColumn('{{subscriptions}}', 'trans_id');

		$this->getDbConnection()->createCommand("
									ALTER TABLE  `subscriptions`
									ADD  `trans_id` VARCHAR(255) AFTER `user_id`
								")->execute();

		$this->createIndex('trans_id', '{{subscriptions}}', 'trans_id', false);
	}

	public function safeDown()
	{
		$this->dropIndex('trans_id', '{{subscriptions}}');
		$this->dropColumn('{{subscriptions}}', 'trans_id');

		$this->getDbConnection()->createCommand("
ALTER TABLE  `subscriptions`
    ADD  `trans_id` INTEGER AFTER `user_id`
                ")->execute();

		$this->createIndex('trans_id', '{{subscriptions}}', 'trans_id', false);
		$this->addForeignKey('fk_subscriptions_trans_id', '{{subscriptions}}','trans_id', '{{subscription_transactions}}','id', 'RESTRICT', 'RESTRICT');

		// clear the cache schema of all loaded tables
		Yii::app()->db->schema->refresh();
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