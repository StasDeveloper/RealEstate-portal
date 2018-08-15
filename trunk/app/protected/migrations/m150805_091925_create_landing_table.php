<?php

class m150805_091925_create_landing_table extends CDbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        /* Yii::app()->getDb()->createCommand()->createTable("{{landing_page}}", array(
             'id' => 'pk',
             'title' => 'string',
             'status' => 'integer',
             'search_id' => 'integer',
             'post_top_id' => 'integer',
             'post_bottom_id' => 'integer',
             'created_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
             'updated_at' => 'DATETIME NULL DEFAULT NULL',
             ),'ENGINE=InnoDB');
         $this->createIndex('status', '{{landing_page}}', 'status', false);
         $this->createIndex('updated_at', '{{landing_page}}', 'updated_at', false
         $this->addForeignKey('search_id', '{{landing_page}}', 'search_id','{{saved_searches}}', 'id', 'RESTRICT', 'RESTRICT');
         $this->addForeignKey('post_top_id', '{{landing_page}}', 'post_top_id','{{post}}', 'id', 'RESTRICT', 'RESTRICT');
         $this->addForeignKey('post_bottom_id', '{{landing_page}}', 'post_bottom_id','{{post}}', 'id', 'RESTRICT', 'RESTRICT');*/

        $this->getDbConnection()->createCommand("
INSERT INTO {{lookup}} (name, type, code, position) VALUES ('Draft', 'LandingPageStatus', 1, 1);
                ")->execute();
        $this->getDbConnection()->createCommand("
INSERT INTO {{lookup}} (name, type, code, position) VALUES ('Published', 'LandingPageStatus', 2, 2);
                ")->execute();
        $this->getDbConnection()->createCommand("
INSERT INTO {{lookup}} (name, type, code, position) VALUES ('Archived', 'LandingPageStatus', 3, 3);
                ")->execute();
    }

    public function safeDown()
    {
        $this->getDbConnection()->createCommand("
            DELETE FROM {{lookup}} WHERE type='LandingPageStatus';
                ")->execute();
            $this->dropTable('{{landing_page}}');
    }
}