<?php

class m180815_085925_create_zipcode_table extends CDbMigration
{
	public function up()
	{
        Yii::app()->getDb()->createCommand()->createTable('zipcode',array(
            'zip_id' => 'integer',
            'zip_code' => 'integer',
            'latitude' => 'string',
            'longitude' => 'string',
            'cityid' => 'integer'
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		echo "m180815_085925_create_zipcode_table does not support migration down.\n";
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