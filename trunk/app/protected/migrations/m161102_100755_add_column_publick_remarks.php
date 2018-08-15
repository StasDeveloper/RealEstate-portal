<?php

class m161102_100755_add_column_publick_remarks extends CDbMigration
{
    public function up()
    {
        Yii::app()->getDb()->createCommand()->addColumn('property_info','public_remarks','varchar(1000)');
        Yii::app()->getDb()->createCommand()->addColumn('property_info_history','public_remarks','varchar(1000)');
    }

    public function down()
    {
        Yii::app()->getDb()->createCommand()->dropColumn('property_info','public_remarks');
        Yii::app()->getDb()->createCommand()->dropColumn('property_info_history','public_remarks');
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