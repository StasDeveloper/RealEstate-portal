<?php

class m150330_070126_update_property_info_table extends CDbMigration
{

    public function safeUp()
    {
        $this->addColumn('property_info','comps',"int(11) NOT NULL DEFAULT '0'");
        $this->dropColumn('property_info','conditional_factor');
        $this->dropColumn('property_info','fundamentals_factor');
    }

    public function safeDown()
    {
        $this->dropColumn('property_info','comps');
    }
}