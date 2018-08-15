<?php

class m150416_105936_update_market_trend_table extends CDbMigration
{
    public function safeUp()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `market_trend_table` 
    CHANGE  `spa`  `spa` enum('', 'No', 'Yes') DEFAULT '',
    CHANGE  `converted_garage`  `converted_garage` enum('', 'No', 'Yes') DEFAULT '',
    CHANGE  `foreclosure`  `foreclosure` enum('', 'No', 'Yes') DEFAULT '',
    CHANGE  `short_sale`  `short_sale` enum('', 'No', 'Yes') DEFAULT ''
                ")->execute();
    }

    public function safeDown()
    {
            echo "m150410_105936_update_property_info does not support migration down.\n";
            return false;
    }

}