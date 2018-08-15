<?php

class m151106_122733_update_subscription_transactions_add_site_sbscr_id extends CDbMigration
{
	public function up()
	{
        $this->getDbConnection()->createCommand("
									ALTER TABLE  `subscription_transactions`
									ADD  `site_sbsrc_id` INTEGER AFTER `user_id`
								")->execute();

        $this->addForeignKey('fk_site_sbsrc_id', '{{subscription_transactions}}','site_sbsrc_id', '{{subscriptions}}','id', 'NO ACTION', 'NO ACTION');
        $this->createIndex('site_sbsrc_id', '{{subscription_transactions}}', 'payer_email', false);

	}

	public function down()
	{
		echo "m151106_122733_update_subscription_transactions_add_site_sbscr_id does not support migration down.\n";
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