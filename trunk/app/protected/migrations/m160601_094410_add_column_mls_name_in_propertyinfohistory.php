<?php

class m160601_094410_add_column_mls_name_in_propertyinfohistory extends CDbMigration
{
	public function up()
	{
		Yii::app()->getDb()->createCommand()->addColumn('property_info_history','mls_name','varchar(50)');
	}

	public function down()
	{
		Yii::app()->getDb()->createCommand()->dropColumn('property_info_history','mls_name');
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