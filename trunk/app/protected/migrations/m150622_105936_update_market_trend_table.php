<?php

class m150622_105936_update_market_trend_table extends CDbMigration
{
    public function safeUp()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `market_trend_table` 
    ADD  `factor_type` enum('', 'fundamentals_factor', 'conditional_factor') DEFAULT '' AFTER  `conditional_factor`,
    ADD  `factor_value` DECIMAL(12,8) DEFAULT '0.0' AFTER  `factor_type`
                ")->execute();
        $this->getDbConnection()->createCommand("
UPDATE `market_trend_table` 
    SET `factor_type`='fundamentals_factor',`factor_value`=`fundamentals_factor` 
    WHERE `conditional_factor` = 0
                ")->execute();
        $this->getDbConnection()->createCommand("
UPDATE `market_trend_table` 
    SET `factor_type`='conditional_factor',`factor_value`=`conditional_factor` 
    WHERE `fundamentals_factor` = 0 AND `factor_type` = ''
                ")->execute();
    }

    public function safeDown()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `market_trend_table` 
    DROP  `factor_type` ,
    DROP  `factor_value`  
                ")->execute();
    }

}