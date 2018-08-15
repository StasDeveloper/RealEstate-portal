<?php

class m150512_105936_update_property_info extends CDbMigration
{
    public function safeUp()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `property_info` 
    CHANGE  `bathrooms`  `bathrooms` DECIMAL( 6, 2 ) NULL DEFAULT  '0.0'
                ")->execute();

        $this->getDbConnection()->createCommand("
ALTER TABLE  `property_info_history` 
    CHANGE  `bathrooms`  `bathrooms` DECIMAL( 6, 2 ) NULL DEFAULT  '0.0'
                ")->execute();
    }

    public function safeDown()
    {
//            echo "m150512_105936_update_property_info does not support migration down.\n";
//            return false;
    }

}