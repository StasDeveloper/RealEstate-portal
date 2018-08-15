<?php

class m150414_105936_update_property_info extends CDbMigration
{
    public function safeUp()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `property_info` 
    CHANGE  `fundamentals_factor`  `fundamentals_factor` DECIMAL( 5, 3 ) NULL DEFAULT  '0',
    CHANGE  `conditional_factor`  `conditional_factor` DECIMAL( 5, 3 ) NULL DEFAULT  '0'
                ")->execute();
        $this->createIndex('property_id', '{{property_info}}', 'property_id', true);
    }

    public function safeDown()
    {
            echo "m150410_105936_update_property_info does not support migration down.\n";
            return false;
    }

}