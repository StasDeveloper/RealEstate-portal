<?php

class m150406_130109_update_compare_estimated_price_table extends CDbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->addColumn('compare_estimated_price_table','min_comp',"tinyint(3) NOT NULL DEFAULT '8'");
        $this->dropColumn('compare_estimated_price_table','house_views_comp');
    }

    public function safeDown()
    {
        $this->dropColumn('compare_estimated_price_table','min_comp');
    }
}