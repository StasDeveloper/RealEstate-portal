<?php

class m150428_150554_update_property_info_additional_details extends CDbMigration
{

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  `property_info_additional_details_history` 
  CHANGE `over_all_property` `over_all_property` varchar(100) NOT NULL,
  CHANGE `exterior_grounds` `exterior_grounds` varchar(100) NOT NULL,
  CHANGE `exterior_structure` `exterior_structure` varchar(100) NOT NULL,
  CHANGE `roof` `roof` varchar(100) NOT NULL,
  CHANGE `ac_system` `ac_system` varchar(100) NOT NULL,
  CHANGE `electrical_system` `electrical_system` varchar(100) NOT NULL,
  CHANGE `interior_structure` `interior_structure` varchar(100) NOT NULL,
  CHANGE `plumbing_system` `plumbing_system` varchar(100) NOT NULL,
  CHANGE `kitchen` `kitchen` varchar(100) NOT NULL
                ")->execute();

//        $this->getDbConnection()->createCommand("
//ALTER TABLE  `property_info_history`
//  CHANGE `property_id` `property_id` int(11) NOT NULL
//                ")->execute();
    }

    public function safeDown()
    {
            echo "m150428_150554_update_property_info_additional_details does not support migration down.\n";
            return false;
    }

}