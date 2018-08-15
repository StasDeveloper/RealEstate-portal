<?php

class m150409_105936_update_property_info extends CDbMigration
{
    public function safeUp()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `property_info` 
    CHANGE  `fundamentals_factor`  `fundamentals_factor` DECIMAL( 5, 2 ) NULL DEFAULT  '0',
    CHANGE  `conditional_factor`  `conditional_factor` DECIMAL( 5, 2 ) NULL DEFAULT  '0.1'
                ")->execute();

    }

    public function safeDown()
    {
            echo "m150409_105936_update_property_info does not support migration down.\n";
            return false;
    }

}