<?php

class m150919_110838_update_ad_client_table extends CDbMigration
{
        
    public function safeUp()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  {{ad_client}} 
    ADD  status INTEGER NOT NULL DEFAULT  '1',
    ADD  for_all TINYINT(1) DEFAULT  '0'
                ")->execute();
        $this->getDbConnection()->createCommand("
INSERT INTO {{lookup}} (name, type, code, position) VALUES ('Inactive', 'AdClientStatus', 1, 1);
                ")->execute();
        $this->getDbConnection()->createCommand("
INSERT INTO {{lookup}} (name, type, code, position) VALUES ('Active', 'AdClientStatus', 2, 2);
                ")->execute();
    }

    public function safeDown()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  {{ad_client}} 
    DROP  `status`,
    DROP  `for_all`
                ")->execute();
        $this->getDbConnection()->createCommand("
DELETE FROM {{lookup}} WHERE type = 'AdClientStatus';
                ")->execute();
    }
}