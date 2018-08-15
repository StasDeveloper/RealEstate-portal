<?php

class m150702_101925_update_compare_estimated_price_table extends CDbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->addColumn('compare_estimated_price_table','sub_type_comp',"tinyint(1) NOT NULL DEFAULT '0'");
    }

    public function safeDown()
    {
        $this->dropColumn('compare_estimated_price_table','sub_type_comp');
    }
}