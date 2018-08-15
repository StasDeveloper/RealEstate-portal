<?php

class m160126_104645_create_subscription_ipn_log extends CDbMigration
{
	public function safeUp()
	{
		Yii::app()->getDb()->createCommand()->createTable("{{subscription_ipn_log}}", array(
			'id' => 'pk',
			'txn_type' => 'VARCHAR(128)',
			'subscr_id' => 'VARCHAR(128)',
			'user_id' => 'integer',
			'custom'=>'TEXT',
			'process_step'=>'TEXT',
			'full_post'=>'TEXT',
			'created_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'updated_at' => 'DATETIME NULL DEFAULT NULL',

		),'ENGINE=InnoDB');
		$this->createIndex('user_id', '{{subscription_ipn_log}}', 'user_id', false);
		$this->createIndex('txn_type', '{{subscription_ipn_log}}', 'txn_type', false);
		$this->createIndex('subscr_id', '{{subscription_ipn_log}}', 'subscr_id', false);

		$this->addForeignKey('fk_subscription_ipn_log_user_id', '{{subscription_ipn_log}}','user_id', '{{users}}','id', 'RESTRICT', 'RESTRICT');

		// clear the cache schema of all loaded tables
		Yii::app()->db->schema->refresh();
	}

	public function safeDown()
	{
		$this->dropForeignKey('fk_subscription_ipn_log_user_id', '{{subscription_ipn_log}}');
		$this->dropIndex('user_id', '{{subscription_ipn_log}}');
		$this->dropIndex('txn_type', '{{subscription_ipn_log}}');
		$this->dropIndex('subscr_id', '{{subscription_ipn_log}}');

		$this->dropTable('{{subscription_ipn_log}}');
		Yii::app()->db->schema->refresh();

		echo "m160126_104645_subscription_ipn_log does not support migration down.\n";
		return false;
	}

}