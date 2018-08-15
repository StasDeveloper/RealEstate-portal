<?php

class m150323_113710_update_property_info_table extends CDbMigration
{
    
    public function safeUp()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `property_info` 
    ADD  `street_number` INT( 11 ) NULL DEFAULT NULL ,
    ADD  `street_name` VARCHAR( 50 ) NULL DEFAULT NULL ,
    ADD  `building_number` TINYINT( 3 ) NULL DEFAULT NULL ,
    ADD  `location` VARCHAR( 12 ) NULL DEFAULT NULL,
    ADD  `property_type_mls` VARCHAR( 22 ) NULL DEFAULT NULL,
    ADD  `elevator_floor` TINYINT( 4 ) NULL DEFAULT NULL,
    ADD  `converted_to_real_property` enum('No', 'Yes') DEFAULT 'No' ,
    ADD  `manufactured` enum('No', 'Yes') DEFAULT 'No' ,
    ADD  `ownership` VARCHAR( 25 ) NULL DEFAULT NULL,
    ADD  `building_description` VARCHAR( 64 ) NULL DEFAULT NULL
                ")->execute();
        $this->getDbConnection()->createCommand("
ALTER TABLE  `property_info_history` 
    ADD  `street_number` INT( 11 ) NULL DEFAULT NULL ,
    ADD  `street_name` VARCHAR( 50 ) NULL DEFAULT NULL ,
    ADD  `building_number` TINYINT( 3 ) NULL DEFAULT NULL ,
    ADD  `location` VARCHAR( 12 ) NULL DEFAULT NULL,
    ADD  `property_type_mls` VARCHAR( 22 ) NULL DEFAULT NULL,
    ADD  `elevator_floor` TINYINT( 4 ) NULL DEFAULT NULL,
    ADD  `converted_to_real_property` enum('No', 'Yes') DEFAULT 'No' ,
    ADD  `manufactured` enum('No', 'Yes') DEFAULT 'No' ,
    ADD  `ownership` VARCHAR( 25 ) NULL DEFAULT NULL,
    ADD  `building_description` VARCHAR( 64 ) NULL DEFAULT NULL
                ")->execute();
    }

    public function safeDown()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE `property_info`
    DROP `street_number`,
    DROP `street_name`,
    DROP `building_number`,
    DROP `location`,
    DROP `property_type_mls`,
    DROP `elevator_floor`,
    DROP `converted_to_real_property`,
    DROP `manufactured`,
    DROP `ownership`,
    DROP `building_description`
                ")->execute();
        $this->getDbConnection()->createCommand("
ALTER TABLE `property_info_history`
    DROP `street_number`,
    DROP `street_name`,
    DROP `building_number`,
    DROP `location`,
    DROP `property_type_mls`,
    DROP `elevator_floor`,
    DROP `converted_to_real_property`,
    DROP `manufactured`,
    DROP `ownership`,
    DROP `building_description`
                ")->execute();
    }
    
/*    
    public function up()
    {
        $this->addColumn('property_info','street_number',"int(11) NULL");
        $this->addColumn('property_info','street_name',"VARCHAR(50) NULL");
        $this->addColumn('property_info','building_number',"tinyint(3) NULL");
        $this->addColumn('property_info','location',"VARCHAR(12) NULL");
        
        $this->addColumn('property_info','property_type_mls',"VARCHAR(22) NULL");
        $this->addColumn('property_info','elevator_floor',"tinyint(4) NULL");
        $this->addColumn('property_info','converted_to_real_property',"enum('No', 'Yes') DEFAULT 'No' ");
        $this->addColumn('property_info','manufactured',"enum('No', 'Yes') DEFAULT 'No' ");
        $this->addColumn('property_info','ownership',"VARCHAR(25) NULL");
        $this->addColumn('property_info','building_description',"VARCHAR(64) NULL");
        
        
        $this->addColumn('property_info_history','street_number',"int(11) NULL");
        $this->addColumn('property_info_history','street_name',"VARCHAR(50) NULL");
        $this->addColumn('property_info_history','building_number',"tinyint(3) NULL");
        $this->addColumn('property_info_history','location',"VARCHAR(12) NULL");
        $this->addColumn('property_info_history','property_type_mls',"VARCHAR(22) NULL");
        $this->addColumn('property_info_history','elevator_floor',"tinyint(4) NULL");
        $this->addColumn('property_info_history','converted_to_real_property',"enum('No', 'Yes') DEFAULT 'No' ");
        $this->addColumn('property_info_history','manufactured',"enum('No', 'Yes') DEFAULT 'No' ");
        $this->addColumn('property_info_history','ownership',"VARCHAR(25) NULL");
        $this->addColumn('property_info_history','building_description',"VARCHAR(64) NULL");
    }

    public function down()
    {
        $this->dropColumn('property_info','street_number');
        $this->dropColumn('property_info','street_name');
        $this->dropColumn('property_info','building_number');
        $this->dropColumn('property_info','location');
        $this->dropColumn('property_info','property_type_mls');
        $this->dropColumn('property_info','elevator_floor');
        $this->dropColumn('property_info','converted_to_real_property');
        $this->dropColumn('property_info','manufactured');
        $this->dropColumn('property_info','ownership');
        $this->dropColumn('property_info','building_description');

        $this->dropColumn('property_info_history','street_number');
        $this->dropColumn('property_info_history','street_name');
        $this->dropColumn('property_info_history','building_number');
        $this->dropColumn('property_info_history','location');
        $this->dropColumn('property_info_history','property_type_mls');
        $this->dropColumn('property_info_history','elevator_floor');
        $this->dropColumn('property_info_history','converted_to_real_property');
        $this->dropColumn('property_info_history','manufactured');
        $this->dropColumn('property_info_history','ownership');
        $this->dropColumn('property_info_history','building_description');    
    }
 */
}