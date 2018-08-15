<?php

class m150831_105936_update_property_info extends CDbMigration
{
    public function safeUp()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `property_info` 
    ADD  `estimated_price_recalc_at` DATETIME NULL DEFAULT NULL AFTER `comp_stage`
                ")->execute();

    }

    public function safeDown()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `property_info` 
    DROP  `estimated_price_recalc_at`
                ")->execute();
    }

}