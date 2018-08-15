<?php

class m150618_105936_create_user_oauth_table extends CDbMigration
{
    public function safeUp()
    {
        $this->getDbConnection()->createCommand("
CREATE TABLE `{{user_oauth}}` (
  `user_id` int(11) NOT NULL,
  `provider` varchar(45) NOT NULL,
  `identifier` varchar(64) NOT NULL,
  `profile_cache` text,
  `session_data` text,
  PRIMARY KEY (`provider`,`identifier`),
  UNIQUE KEY `unic_user_id_name` (`user_id`,`provider`),
  KEY `oauth_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                ")->execute();
    }

    public function safeDown()
    {
        $this->getDbConnection()->createCommand("
DROP TABLE  `{{user_oauth}}` 
                ")->execute();
    }

}