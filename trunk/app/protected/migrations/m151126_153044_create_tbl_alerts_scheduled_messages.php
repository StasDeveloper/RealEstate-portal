<?php

class m151126_153044_create_tbl_alerts_scheduled_messages extends CDbMigration
{
	public function safeUp()
	{
		Yii::app()->getDb()->createCommand()->createTable("{{alerts_scheduled_messages}}", array(
			'id' => 'pk',
			'date' => 'DATE',
			'message_1' => 'TEXT',
			'message_2' => 'TEXT',
			'message_3' => 'TEXT',
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');

		Yii::app()->db->schema->refresh();
	}

	public function safeDown()
	{
		$this->dropTable('{{alerts_scheduled_messages}}');
		Yii::app()->db->schema->refresh();
	}
}