<?php

class m150623_105936_update_market_trend_table extends CDbMigration
{
    public function safeUp()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `market_trend_table` 
    DROP  `fundamentals_factor` ,
    DROP  `conditional_factor`
                ")->execute();
    }

    public function safeDown()
    {
            echo "m150623_105936_update_market_trend_table does not support migration down.\n";
            return false;
    }

}