<?php

class m150520_105937_update_property_info extends CDbMigration
{
    public function safeUp()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `property_info` 
    CHANGE  `fundamentals_factor`  `fundamentals_factor` DECIMAL( 12,8 ) NULL DEFAULT  '0.0',
    CHANGE  `conditional_factor`  `conditional_factor` DECIMAL( 12,8 ) NULL DEFAULT  '0.0'
                ")->execute();
    }

    public function safeDown()
    {
//            echo "m150520_105937_update_property_info does not support migration down.\n";
//            return false;
    }

}