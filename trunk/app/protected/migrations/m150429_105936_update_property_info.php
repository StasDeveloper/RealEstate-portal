<?php

class m150429_105936_update_property_info extends CDbMigration
{
    public function safeUp()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `property_info` 
    CHANGE  `percentage_depreciation_value`  `percentage_depreciation_value` DECIMAL( 5, 2 ) NULL DEFAULT  '0.0'
                ")->execute();

        $this->getDbConnection()->createCommand("
ALTER TABLE  `property_info_history` 
    CHANGE  `percentage_depreciation_value`  `percentage_depreciation_value` DECIMAL( 5, 2 ) NULL DEFAULT  '0.0'
                ")->execute();
    }

    public function safeDown()
    {
            echo "m150429_105936_update_property_info does not support migration down.\n";
            return false;
    }

}