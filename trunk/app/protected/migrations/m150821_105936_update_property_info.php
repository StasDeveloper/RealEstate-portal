<?php

class m150821_105936_update_property_info extends CDbMigration
{
    public function safeUp()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `property_info` 
    ADD  `house_square_footage_gravity` DECIMAL( 10, 8 ) NULL DEFAULT  '1.0',
    ADD  `lot_footage_gravity` DECIMAL( 10, 8 ) NULL DEFAULT  '1.0'
                ")->execute();

    }

    public function safeDown()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `property_info` 
    DROP  `house_square_footage_gravity`,
    DROP  `lot_footage_gravity`
                ")->execute();
    }

}