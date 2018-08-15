<?php

class m150810_150838_update_saved_searches_table extends CDbMigration
{
    public function safeUp()
    {
        $this->getDbConnection()->createCommand("
ALTER TABLE  {{tbl_saved_searches}} 
    CHANGE  `user_id`  `user_id` INT( 11 ) NOT NULL 
                ")->execute();
        $this->createIndex('user_id', '{{tbl_saved_searches}}', 'user_id', false);
    }

	public function safeDown()
	{
        $this->getDbConnection()->createCommand("
ALTER TABLE  {{tbl_saved_searches}} 
    CHANGE  `user_id`  `user_id` VARCHAR( 255 ) NOT NULL 
                ")->execute();
            $this->dropIndex('user_id', '{{tbl_saved_searches}}' );
	}

}