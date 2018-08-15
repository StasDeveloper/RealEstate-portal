<?php

class m150819_105936_update_market_trend_table extends CDbMigration
{
    public function safeUp()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `market_trend_table` 
    ADD  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ADD  `updated_at` DATETIME NULL DEFAULT NULL
                ")->execute();
        $this->getDbConnection()->createCommand("
UPDATE `market_trend_table` 
    SET `factor_value` = `factor_min`,`updated_at`= NOW()
    WHERE `factor_value` < `factor_min`
                ")->execute();
        $this->getDbConnection()->createCommand("
UPDATE `market_trend_table` 
    SET `factor_value` = `factor_max`,`updated_at`= NOW()
    WHERE `factor_value` > `factor_max`
                ")->execute();
    }

    public function safeDown()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `market_trend_table` 
    DROP  `created_at` ,
    DROP  `updated_at`  
                ")->execute();
    }

}