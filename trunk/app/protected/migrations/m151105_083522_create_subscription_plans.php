<?php

class m151105_083522_create_subscription_plans extends CDbMigration
{
	public function safeUp()
	{
		Yii::app()->getDb()->createCommand()->createTable("{{subscription_plans}}", array(
			'id' => 'pk',
			'service_name' => 'VARCHAR(128)',
			'price' => 'DECIMAL(10,2)',
			'price_type' => 'VARCHAR(128)',
			'period' => 'VARCHAR(128)',
			'created_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'updated_at' => 'DATETIME NULL DEFAULT NULL',
		),'ENGINE=InnoDB');

		$this->createIndex('service_name', '{{subscription_plans}}', 'service_name', false);


		// clear the cache schema of all loaded tables
		Yii::app()->db->schema->refresh();
	}

	public function safeDown()
	{
		echo "m151105_083522_create_subscription_plans does not support migration down.\n";
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