<?php

class m150720_101925_create_seourl_tables extends CDbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {

        if (!Yii::app()->getDb()->schema->getTable('yiiseo_url')) {
            Yii::app()->getDb()->createCommand()->createTable("yiiseo_url", array(
                'id' => 'pk',
                'url' => 'string',
                'language' => 'string',
                'created_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
                'updated_at' => 'DATETIME NULL DEFAULT NULL',
                ),'ENGINE=InnoDB');
            $this->createIndex('url', 'yiiseo_url', 'url', false);
            $this->createIndex('updated_at', 'yiiseo_url', 'updated_at', false);
        }

        if (!Yii::app()->getDb()->schema->getTable('yiiseo_main')) {
            Yii::app()->getDb()->createCommand()->createTable("yiiseo_main", array(
                'id' => 'pk',
                'url' => 'integer',
                'name' => 'string',
                'content' => 'text',
                'active' => 'boolean',
                'created_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
                'updated_at' => 'DATETIME NULL DEFAULT NULL',
            ),'ENGINE=InnoDB');
            Yii::app()->getDb()->createCommand()->addForeignKey('url', 'yiiseo_main', 'url','yiiseo_url', 'id', 'CASCADE', 'CASCADE');
            $this->createIndex('updated_at', 'yiiseo_main', 'updated_at', false);
        }

        if (!Yii::app()->getDb()->schema->getTable('yiiseo_property')) {
            Yii::app()->getDb()->createCommand()->createTable("yiiseo_property", array(
                'id' => 'pk',
                'url' => 'integer',
                'name' => 'string',
                'content' => 'text',
                'created_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
                'updated_at' => 'DATETIME NULL DEFAULT NULL',
            ),'ENGINE=InnoDB');
            Yii::app()->getDb()->createCommand()->addForeignKey('url1', 'yiiseo_property', 'url','yiiseo_url', 'id', 'CASCADE', 'CASCADE');
            $this->createIndex('updated_at', 'yiiseo_property', 'updated_at', false);
        }

    }

    public function safeDown()
    {
            $this->dropTable('yiiseo_main');
            $this->dropTable('yiiseo_property');
            $this->dropTable('yiiseo_url');
    }
}