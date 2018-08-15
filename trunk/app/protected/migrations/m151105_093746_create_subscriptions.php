<?php

class m151105_093746_create_subscriptions extends CDbMigration
{
	public function safeUp()
	{
        Yii::app()->getDb()->createCommand()->createTable("{{subscriptions}}", array(

                'id' => 'pk',
                'user_id' => 'integer',
                'subscription_id' => 'integer',
                'payment_date' => 'DATETIME NULL DEFAULT NULL',
                'status' => 'VARCHAR(128)',
                'items_count' => 'integer',
                'created_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
                'updated_at' => 'DATETIME NULL DEFAULT NULL',

        ),'ENGINE=InnoDB');
        $this->createIndex('status', '{{subscriptions}}', 'status', false);
        $this->createIndex('updated_at', '{{subscriptions}}', 'updated_at', false);
        $this->createIndex('user_id', '{{subscriptions}}', 'user_id', false);

        $this->addForeignKey('fk_subscriptions_user_id', '{{subscriptions}}', 'user_id','{{users}}', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('subscription_id', '{{subscriptions}}', 'subscription_id','{{subscription_plans}}', 'id', 'RESTRICT', 'RESTRICT');

        // clear the cache schema of all loaded tables
        Yii::app()->db->schema->refresh();
	}

	public function safeDown()
	{
		echo "m151105_093746_create_subscriptions does not support migration down.\n";
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