<?php

class m150519_115936_update_market_trend_table extends CDbMigration
{

    public function safeUp()
    {
        $this->addColumn('market_trend_table','factor_included',"tinyint(1) DEFAULT '1'");
    }

    public function safeDown()
    {
        $this->dropColumn('market_trend_table','factor_included');
    }

}