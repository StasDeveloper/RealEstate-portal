<?php

class m151105_104601_create_subscription_transactions extends CDbMigration
{
	public function safeUp()
	{
		Yii::app()->getDb()->createCommand()->createTable("{{subscription_transactions}}", array(
			'id' => 'pk',

			'user_id' => 'integer',
			'txn_id' => 'VARCHAR(256)',
			'payment_date' => 'DATETIME NULL DEFAULT NULL',
			'txn_type' => 'VARCHAR(128)',
			'subscr_id' => 'VARCHAR(128)',
			'recurring' => 'TINYINT',
			'item_name' => 'VARCHAR(255)',
			'payment_status' => 'VARCHAR(128)',
			'payment_gross' => 'DECIMAL(10,2)',
			'mc_gross' => 'DECIMAL(10,2)',
			'mc_currency' => 'VARCHAR(128)',
			'business' => 'VARCHAR(255)',
			'payer_status' => 'VARCHAR(128)',
			'payer_email' => 'VARCHAR(255)',
			'receiver_email' => 'VARCHAR(255)',
			'custom'=>'TEXT',
			'full_txn_info'=>'TEXT',
			'created_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'updated_at' => 'DATETIME NULL DEFAULT NULL',

		),'ENGINE=InnoDB');
		$this->createIndex('user_id', '{{subscription_transactions}}', 'user_id', false);
		$this->createIndex('txn_id', '{{subscription_transactions}}', 'txn_id', false);
		$this->createIndex('payer_email', '{{subscription_transactions}}', 'payer_email', false);

		$this->addForeignKey('fk_subscription_transactions_user_id', '{{subscription_transactions}}','user_id', '{{users}}','id', 'RESTRICT', 'RESTRICT');

		// clear the cache schema of all loaded tables
		Yii::app()->db->schema->refresh();

	}

	public function safeDown()
	{
		echo "m151105_104601_create_subscription_transactions does not support migration down.\n";
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