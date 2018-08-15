<?php

class m180815_094447_create_state_table extends CDbMigration
{
	public function up()
	{
        Yii::app()->getDb()->createCommand()->createTable('county',array(
            'stid' => 'integer',
            'state_name' => 'string',
            'state_code' => 'string',
            'country_id' => 'integer',
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		echo "m180815_094447_create_state_table does not support migration down.\n";
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