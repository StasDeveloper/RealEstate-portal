<?php

class m150303_125251_create_table_property_info_cron_load_photo extends CDbMigration
{
	public function up()
	{
            $this->createTable('{{property_info_cron_load_photo}}', array(
                'id' => 'pk',
                'mls_sysid' => 'BIGINT',
                'process' => 'INT(1)',
                'created_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
                'process_at' => 'DATETIME NULL DEFAULT NULL',
            ));
            $this->createIndex('mls_sysid', '{{property_info_cron_load_photo}}', 'mls_sysid', true);
            $this->createIndex('process_at', '{{property_info_cron_load_photo}}', 'process_at', false);
	}

	public function down()
	{
            $this->dropTable('{{property_info_cron_load_photo}}');
        }

}