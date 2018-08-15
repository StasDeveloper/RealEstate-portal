<?php

class m150604_105936_update_market_trend_table extends CDbMigration
{
    public function safeUp()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `market_trend_table` 
    ADD  `studio` enum('', 'No', 'Yes') NULL DEFAULT '',
    ADD  `condo_conversion`  enum('', 'No', 'Yes') NULL DEFAULT '',
    ADD  `association_features_available` VARCHAR(50) NULL DEFAULT '',
    ADD  `association_fee_1` INT(11) NULL DEFAULT '0',
    ADD  `assessment` enum('', 'No', 'Yes') NULL DEFAULT '',
    ADD  `sidlid` enum('', 'No', 'Yes') NULL DEFAULT '',
    ADD  `parking_description` VARCHAR(50) NULL DEFAULT '',
    ADD  `fence_type` VARCHAR(60) NULL DEFAULT '',
    ADD  `court_approval`  enum('', 'No', 'Yes') NULL DEFAULT '',
    
    ADD  `bath_downstairs` enum('', 'No', 'Yes') NULL DEFAULT '',
    ADD  `bedroom_downstairs` enum('', 'No', 'Yes') NULL DEFAULT '',
    ADD  `great_room` enum('', 'No', 'Yes') NULL DEFAULT '',
    ADD  `bath_downstairs_description` VARCHAR(20) NULL DEFAULT '',
    ADD  `flooring_description` VARCHAR(20) NULL DEFAULT '',
    ADD  `furnishings_description` VARCHAR(36) NULL DEFAULT '',
    
    ADD  `heating_features` VARCHAR(50) NULL DEFAULT '',
    ADD  `possession_description` enum('', 'Estimated Completion Date', 'Current Lease Agreement', 'By Agreement-CLA', 'Close of Escrow', 'Immediate') NULL DEFAULT '',
    ADD  `financing_considered` VARCHAR(20) NULL DEFAULT '',
    ADD  `reporeo` enum('', 'No', 'Yes') NULL DEFAULT '',
    ADD  `litigation` enum('', 'Unknown', 'No', 'Yes') NULL DEFAULT ''
                ")->execute();
    }







    public function safeDown()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `market_trend_table` 
    DROP  `studio` ,
    DROP  `condo_conversion`  ,
    DROP  `association_features_available` ,
    DROP  `association_fee_1` ,
    DROP  `assessment` ,
    DROP  `sidlid` ,
    DROP  `parking_description` ,
    DROP  `fence_type`,
    DROP  `court_approval`  ,
    
    DROP  `bath_downstairs` ,
    DROP  `bedroom_downstairs` ,
    DROP  `great_room` ,
    DROP  `bath_downstairs_description` ,
    DROP  `flooring_description` ,
    DROP  `furnishings_description` ,
    
    DROP  `heating_features`,
    DROP  `possession_description`,
    DROP  `financing_considered` ,
    DROP  `reporeo` ,
    DROP  `litigation` 
                ")->execute();
    }

}