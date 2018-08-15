<?php

class m180815_090826_create_county_table extends CDbMigration
{
	public function up()
	{
        Yii::app()->getDb()->createCommand()->createTable('county',array(
            'county_id' => 'integer',
            'county_name' => 'string',
            'state_id' => 'string',
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		echo "m180815_090826_create_county_table does not support migration down.\n";
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