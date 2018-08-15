<?php

class m150406_090448_create_market_trend_table extends CDbMigration
{

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('market_trend_table', array(
            'id' => 'pk',
            'property_type' => 'TINYINT(3)',
            'property_zipcode' => 'INT(8)',
            't_count' => 'INT(11)',
            'avg_percentage_diff' => 'DECIMAL(5,2)',
            'fundamentals_factor' => 'DECIMAL(5,2)',
            'conditional_factor' => 'DECIMAL(5,2)',
            'compass_point' => "enum('', 'South', 'North', 'West', 'East') DEFAULT '' ",
            'house_faces' => "enum('', 'South', 'North', 'West', 'East', 'M', 'G') DEFAULT ''",
            'house_views' => 'VARCHAR( 100 ) NULL DEFAULT NULL',
            'street_name' => 'VARCHAR( 50 ) NULL DEFAULT NULL',
            'pool' => 'TINYINT(4)',
            'spa' => "enum('No', 'Yes') DEFAULT 'No'",
            'stories' => 'VARCHAR( 30 ) NULL DEFAULT NULL',
            'lot_description' => 'VARCHAR( 100 ) NULL DEFAULT NULL',
            'building_description' => 'VARCHAR( 64 ) NULL DEFAULT NULL',
            'carport_type' => "enum('', 'Attached Carport', 'Detached Carport') DEFAULT ''",
            'converted_garage' => "enum('No', 'Yes') DEFAULT 'No'",
            'exterior_structure' => 'VARCHAR( 10 ) NULL DEFAULT NULL',
            'roof' => 'VARCHAR( 100 ) NULL DEFAULT NULL',
            'electrical_system' => 'VARCHAR( 100 ) NULL DEFAULT NULL',
            'plumbing_system' => 'VARCHAR( 12 ) NULL DEFAULT NULL',
            'built_desc' => 'VARCHAR( 18 ) NULL DEFAULT NULL',
            'exterior_grounds' => 'VARCHAR( 100 ) NULL DEFAULT NULL',
            'prop_desc' => 'VARCHAR( 128 ) NULL DEFAULT NULL',
            'over_all_property' => 'VARCHAR( 12 ) NULL DEFAULT NULL',
            'foreclosure' => "enum('No', 'Yes') DEFAULT 'No'",
            'short_sale' => "enum('No', 'Yes') DEFAULT 'No'",
            
        ));
        $this->getDbConnection()->createCommand("
ALTER TABLE  `property_info` 
  
    ADD  `fundamentals_factor` DECIMAL(5,2) ,
    ADD  `conditional_factor` DECIMAL(5,2) 
                ")->execute();
    }

    public function safeDown()
    {
        $this->dropTable('market_trend_table');
        $this->getDbConnection()->createCommand("
ALTER TABLE `property_info`
    DROP `fundamentals_factor`,
    DROP `conditional_factor`
                ")->execute();

    }

}