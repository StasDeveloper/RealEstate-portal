<?php

class m150630_101925_update_compare_estimated_price_table extends CDbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `compare_estimated_price_table` 
    ADD  `bathrooms_weighted` INT(11) DEFAULT '5' AFTER  `house_weighted`,
    ADD  `bedrooms_weighted` INT(11) DEFAULT '2' AFTER  `bathrooms_weighted`,
    ADD  `garages_weighted` INT(11) DEFAULT '3' AFTER  `bedrooms_weighted`,
    ADD  `pool_weighted` INT(11) DEFAULT '5' AFTER  `garages_weighted`,
    DROP `amenties_weighted`
                ")->execute();
    }

    public function safeDown()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `compare_estimated_price_table` 
    DROP  `bathrooms_weighted`,
    DROP  `bedrooms_weighted`,
    DROP  `garages_weighted`,
    DROP  `pool_weighted`,
    ADD `amenties_weighted` INT(11) DEFAULT '15' AFTER  `house_weighted`
                ")->execute();
    }
}