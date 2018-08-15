<?php

class m150609_105936_update_market_trend_table extends CDbMigration
{
    public function safeUp()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `market_trend_table` 
    ADD  `factor_min` DECIMAL(12,8) DEFAULT '0.0' AFTER  `conditional_factor`,
    ADD  `factor_max` DECIMAL(12,8) DEFAULT '0.0' AFTER  `factor_min`
                ")->execute();
    }

    public function safeDown()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `market_trend_table` 
    DROP  `factor_min` ,
    DROP  `factor_max`  
                ")->execute();
    }

}