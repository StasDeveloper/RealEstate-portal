<?php

class m141218_110331_add_index_photonew extends CDbMigration
{
	public function up()
	{
            $this->createIndex('property_id', 'tbl_property_info_photo', 'property_id', false);
	}

	public function down()
	{
            $this->dropIndex('property_id', 'tbl_property_info_photo' );
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