<?php

class m150220_103636_create_property_info_cron_estimated_price extends CDbMigration
{
    public function up()
    {
        $this->createTable('{{property_info_cron_estimated_price}}', array(
            'est_id' => 'integer',
            'property_zipcode' => 'integer',
            'last_property_id' => 'integer',
        ));
    }

    public function down()
    {
        $this->dropTable('{{property_info_cron_estimated_price}}');
    }
}