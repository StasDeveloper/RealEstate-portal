<?php

class m150715_125251_create_table_property_info_slug extends CDbMigration
{
	public function safeUp()
	{
        $this->getDbConnection()->createCommand("
            SET FOREIGN_KEY_CHECKS=0;
        ")->execute();
            $this->createTable('{{property_info_slug}}', array(
                'id' => 'pk',
                'property_id' => 'INT(11)',
                'slug' => 'VARCHAR(255)',
                'created_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
                'updated_at' => 'DATETIME NULL DEFAULT NULL',
            ));
            $this->createIndex('property_id', '{{property_info_slug}}', 'property_id', true);
            $this->createIndex('slug', '{{property_info_slug}}', 'slug', false);
            $this->addForeignKey('FK_slug_property_info','{{property_info_slug}}','property_id','property_info','property_id','CASCADE', 'CASCADE');

        $this->getDbConnection()->createCommand("
            SET FOREIGN_KEY_CHECKS=1;
        ")->execute();
	}

	public function safeDown()
	{
            $this->dropTable('{{property_info_slug}}');
        }

}