<?php

class m150911_110838_create_ad_client_table extends CDbMigration
{
	public function safeUp()
	{
            $this->createTable('{{ad_client_category}}', array(
                'id' => 'pk',
                'ad_category' => 'VARCHAR(128)',
            ));	
            $this->getDbConnection()->createCommand("
INSERT INTO {{ad_client_category}} (ad_category) VALUES ('Property Manager');
            ")->execute();
            $this->getDbConnection()->createCommand("
INSERT INTO {{ad_client_category}} (ad_category) VALUES ('Lender');
            ")->execute();
            $this->getDbConnection()->createCommand("
INSERT INTO {{ad_client_category}} (ad_category) VALUES ('Insurance');
            ")->execute();
            $this->getDbConnection()->createCommand("
INSERT INTO {{ad_client_category}} (ad_category) VALUES ('Pool Service');
            ")->execute();

            $this->createTable('{{ad_client}}', array(
                'id' => 'pk',
                'ad_category_id' => 'integer',
                'company_name' => 'string NOT NULL',
                'rep_name' => 'VARCHAR(128)',
                'company_logo' => 'string',
                'company_address' => 'string',
                'company_website' => 'string',
                'contact_phone_number' => 'VARCHAR(12)',
                'alt_contact_phone_number' => 'VARCHAR(12)',
                'contact_email' => 'VARCHAR(128)',
                'alt_contact_email' => 'VARCHAR(128)',
                'ad_tag_line' => 'string',
                'ad_description' => 'text',
                'ad_confirmation_message' => 'text',
                'message_to_advertiser' => 'text',
                'updated_at' => 'DATETIME NULL DEFAULT NULL',
                'created_at' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
            ));
            $this->addForeignKey('FK_ad_category_id', '{{ad_client}}', 'ad_category_id','{{ad_client_category}}', 'id', 'RESTRICT', 'RESTRICT');
            $this->createTable('{{ad_client_state}}', array(
                'id' => 'pk',
                'ad_client_id' => 'integer',
                'ad_state_id' => 'integer',
            ));	
            $this->createIndex('ad_state_id', '{{ad_client_state}}', 'ad_state_id', false);
            $this->addForeignKey('FK_ad_state_client_id', '{{ad_client_state}}', 'ad_client_id','{{ad_client}}', 'id', 'CASCADE', 'RESTRICT');
            $this->createTable('{{ad_client_county}}', array(
                'id' => 'pk',
                'ad_client_id' => 'integer',
                'ad_county_id' => 'integer',
            ));	
            $this->createIndex('ad_county_id', '{{ad_client_county}}', 'ad_county_id', false);
            $this->addForeignKey('FK_ad_county_client_id', '{{ad_client_county}}', 'ad_client_id','{{ad_client}}', 'id', 'CASCADE', 'RESTRICT');
            $this->createTable('{{ad_client_city}}', array(
                'id' => 'pk',
                'ad_client_id' => 'integer',
                'ad_city_id' => 'integer',
            ));	
            $this->createIndex('ad_city_id', '{{ad_client_city}}', 'ad_city_id', false);
            $this->addForeignKey('FK_ad_city_client_id', '{{ad_client_city}}', 'ad_client_id','{{ad_client}}', 'id', 'CASCADE', 'RESTRICT');
            $this->createTable('{{ad_client_zipcode}}', array(
                'id' => 'pk',
                'ad_client_id' => 'integer',
                'ad_zipcode_id' => 'integer',
            ));	
            $this->createIndex('ad_zipcode_id', '{{ad_client_zipcode}}', 'ad_zipcode_id', false);
            $this->addForeignKey('FK_ad_zipcode_client_id', '{{ad_client_zipcode}}', 'ad_client_id','{{ad_client}}', 'id', 'CASCADE', 'RESTRICT');

        }

	public function safeDown()
	{
            $this->dropTable('{{ad_client_state}}');
            $this->dropTable('{{ad_client_county}}');
            $this->dropTable('{{ad_client_city}}');
            $this->dropTable('{{ad_client_zipcode}}');
            $this->dropTable('{{ad_client}}');
            $this->dropTable('{{ad_client_category}}');
        }
}