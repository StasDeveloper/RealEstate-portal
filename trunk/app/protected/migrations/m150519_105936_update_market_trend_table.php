<?php

class m150519_105936_update_market_trend_table extends CDbMigration
{
    public function safeUp()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `market_trend_table` 
    CHANGE  `fundamentals_factor`  `fundamentals_factor` DECIMAL(8,4) DEFAULT '0.0',
    CHANGE  `conditional_factor`  `conditional_factor` DECIMAL(8,4) DEFAULT '0.0'
                ")->execute();
    }

    public function safeDown()
    {
//            echo "m150519_105936_update_property_info does not support migration down.\n";
//            return false;
    }

}