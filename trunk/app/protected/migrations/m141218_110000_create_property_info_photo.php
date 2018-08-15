<?php

class m141218_110000_create_property_info_photo extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_property_info_photo', array(
            'id' => 'pk',
            'property_id' => 'integer',
            'photo2' => 'string',
            'caption2' => 'string',
            'photo3' => 'string',
            'caption3' => 'string',
            'photo4' => 'string',
            'caption4' => 'string',
            'photo5' => 'string',
            'caption5' => 'string',
            'photo6' => 'string',
            'photo7' => 'string',
            'photo8' => 'string',
            'photo9' => 'string',
            'photo10' => 'string',
            'photo11' => 'string',
            'photo12' => 'string',
            'photo13' => 'string',
            'photo14' => 'string',
            'photo15' => 'string',
            'photo16' => 'string',
            'photo17' => 'string',
            'photo18' => 'string',
            'photo19' => 'string',
            'photo20' => 'string',
            'photo21' => 'string',
            'photo22' => 'string',
            'photo23' => 'string',
            'photo24' => 'string',
            'photo25' => 'string',
            'photo26' => 'string',
            'photo27' => 'string',
            'photo28' => 'string',
            'photo29' => 'string',
            'photo30' => 'string',
            'photo31' => 'string',
            'photo32' => 'string',
            'photo33' => 'string',
            'photo34' => 'string',
            'photo35' => 'string',
            'photo36' => 'string',
            'photo37' => 'string',
            'photo38' => 'string',
            'photo39' => 'string',
            'photo40' => 'string',

        ));
    }

    public function down()
    {
        $this->dropTable('tbl_property_info_photo');
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