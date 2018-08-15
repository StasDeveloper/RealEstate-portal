<?php

class m180814_143733_create_tbl_session extends CDbMigration
{
	public function up()
	{

        Yii::app()->getDb()->createCommand()->createTable('tbl_session',array(
            'id'=>'CHAR(32) PRIMARY KEY',
            'expire'=>'integer',
            'data'=>'LONGBLOB',
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		echo "m180814_143733_create_tbl_session does not support migration down.\n";
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