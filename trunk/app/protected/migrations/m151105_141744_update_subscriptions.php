<?php

class m151105_141744_update_subscriptions extends CDbMigration
{
	public function safeUp()
	{
        $this->getDbConnection()->createCommand("
ALTER TABLE  `subscriptions`
    ADD  `subscr_id` VARCHAR(255) AFTER `trans_id`
                ")->execute();

        $this->createIndex('subscr_id', '{{subscriptions}}', 'subscr_id', false);

        // clear the cache schema of all loaded tables
        Yii::app()->db->schema->refresh();
	}

	public function safeDown()
	{
        $this->getDbConnection()->createCommand("
ALTER TABLE  `subscriptions`
    DROP  `subscr_id`
                ")->execute();
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