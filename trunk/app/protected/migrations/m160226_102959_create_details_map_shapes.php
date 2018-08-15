<?php

class m160226_102959_create_details_map_shapes extends CDbMigration
{
	/*
	public function up()
	{
	}

	public function down()
	{
		echo "m160226_102959_create_details_map_shapes does not support migration down.\n";
		return false;
	}
	*/

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
		Yii::app()->getDb()->createCommand()->createTable("{{details_map_shapes}}", array(
			'id' => 'pk',
			'session_id' => 'VARCHAR(50) NOT NULL',
			'prop_id' => 'integer NOT NULL',
			'shape' => 'TEXT',
			'excluded_props_by_shape' => 'TEXT',
			'created_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP'
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');

		Yii::app()->db->schema->refresh();
	}

	public function safeDown()
	{
		$this->dropTable('{{details_map_shapes}}');
		Yii::app()->db->schema->refresh();

		echo "m160226_102959_create_details_map_shapes does not support migration down.\n";
		return true;
	}
}