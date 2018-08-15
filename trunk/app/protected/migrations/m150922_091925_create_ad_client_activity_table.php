<?php

class m150922_091925_create_ad_client_activity_table extends CDbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        Yii::app()->getDb()->createCommand()->createTable("{{ad_client_activity}}", array(
            'id' => 'pk',
            'status_activity' => "INT(11) DEFAULT '1'",
            'client_id' => 'integer',
            'user_id' => 'integer',
            'user_first_name' => 'VARCHAR(128)',
            'user_last_name' => 'VARCHAR(128)',
            'user_phone_number' => 'VARCHAR(12)',
            'user_email' => 'VARCHAR(128)',
            'user_address' => 'VARCHAR(256)',
            'user_comment' => 'TEXT',
            'user_lon' => 'FLOAT(10,6)',
            'user_lat' => 'FLOAT(10,6)',
            'created_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'updated_at' => 'DATETIME NULL DEFAULT NULL',
            ),'ENGINE=InnoDB');
        $this->createIndex('status_activity', '{{ad_client_activity}}', 'status_activity', false);
        $this->createIndex('updated_at', '{{ad_client_activity}}', 'updated_at', false);
        $this->createIndex('user_id', '{{ad_client_activity}}', 'user_id', false);
        
        $this->addForeignKey('user_id', '{{ad_client_activity}}', 'user_id','{{users}}', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('client_id', '{{ad_client_activity}}', 'client_id','{{ad_client}}', 'id', 'RESTRICT', 'RESTRICT');

        $this->getDbConnection()->createCommand("
INSERT INTO {{lookup}} (name, type, code, position) VALUES ('Pending Approval', 'AdClientActivityStatus', 1, 1);
                ")->execute();
        $this->getDbConnection()->createCommand("
INSERT INTO {{lookup}} (name, type, code, position) VALUES ('Approved', 'AdClientActivityStatus', 2, 2);
                ")->execute();
        $this->getDbConnection()->createCommand("
INSERT INTO {{lookup}} (name, type, code, position) VALUES ('Sended', 'AdClientActivityStatus', 3, 3);
                ")->execute();

        // clear the cache schema of all loaded tables
        Yii::app()->db->schema->refresh();

    }

    public function safeDown()
    {
        $this->getDbConnection()->createCommand("
            DELETE FROM {{lookup}} WHERE type='AdClientActivityStatus';
                ")->execute();
            $this->dropTable('{{ad_client_activity}}');
    }
}