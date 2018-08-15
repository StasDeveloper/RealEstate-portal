<?php

class m180815_090643_create_city_table extends CDbMigration
{
	public function up()
	{
        Yii::app()->getDb()->createCommand()->createTable('city',array(
            'cityid' => 'integer',
            'city_name' => 'string',
            'county_id' => 'integer',
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8');


	}

	public function down()
	{
		echo "m180815_090643_create_city_table does not support migration down.\n";
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