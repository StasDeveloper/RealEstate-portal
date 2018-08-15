<?php

class m150513_105936_update_market_trend_table extends CDbMigration
{

    public function safeUp()
    {
        $this->addColumn('market_trend_table','sub_type',"VARCHAR(50) NULL DEFAULT ''");
    }

    public function safeDown()
    {
        $this->dropColumn('market_trend_table','sub_type');
    }

}