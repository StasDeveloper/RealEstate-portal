<?php

class m151126_110826_create_tbl_alerts_messages extends CDbMigration
{
	public function safeUp()
	{
        $this->getDbConnection()->createCommand("
                                                CREATE TABLE `tbl_alerts_messages` (
                                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                                    `document` varchar(250) NOT NULL DEFAULT '',
                                                    PRIMARY KEY (`id`)
                                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                                                                ")->execute();

        Yii::app()->db->schema->refresh();
	}

	public function safeDown()
	{
        // clear the cache schema of all loaded tables
        $this->dropTable('{{alerts_messages}}');
        Yii::app()->db->schema->refresh();
	}


}