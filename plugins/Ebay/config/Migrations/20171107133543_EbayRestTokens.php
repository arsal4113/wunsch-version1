<?php

use Migrations\AbstractMigration;

class EbayRestTokens extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('ebay_rest_api_access_tokens');
        if (!$table->exists()) {
            $table
                ->addColumn('ebay_account_id', 'integer', ['limit' => 10])
                ->addColumn('token', 'text')
                ->addColumn('grant_type', 'string', ['limit' => 100])
                ->addColumn('scope', 'string', ['limit' => 500])
                ->addColumn('expire_datetime', 'datetime')
                ->addColumn('created', 'datetime', ['null' => true, 'default' => null])
                ->addColumn('modified', 'datetime', ['null' => true, 'default' => null])
                ->addForeignKey('ebay_account_id', 'ebay_accounts', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
                ->create();
        }
        $ebayAccountType = $this->fetchRow('SELECT id FROM ebay_account_types WHERE type = "sandbox"');
        if (isset($ebayAccountType['id'])) {

            $newCredentials = [
                [
                    'ebay_account_type_id' => $ebayAccountType['id'],
                    'key_set_name' => 'disco_dev',
                    'app_id' => 'iwayssal-IwaysDis-SBX-6134e8f72-c650a393',
                    'dev_id' => '33ca2d15-c945-44db-8761-3308ab296139',
                    'cert_id' => 'SBX-134e8f7261c8-c6e3-4560-bb21-b074',
                    'ru_name' => 'i-ways_sales_so-iwayssal-IwaysD-okgxyghsl',
                    'is_active' => 1,
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ]
            ];
            $this->insert('ebay_credentials', $newCredentials);

            $discoCredential = $this->fetchRow('SELECT id FROM ebay_credentials WHERE key_set_name = "disco_dev"');
            $coreSeller = $this->fetchRow('SELECT id FROM core_sellers WHERE is_active = 1 limit 1');

            if (isset($discoCredential['id']) && isset($coreSeller['id'])) {
                $discoEbayAccount = [
                    [
                        'ebay_account_type_id' => $ebayAccountType['id'],
                        'ebay_credential_id' => $discoCredential['id'],
                        'core_seller_id' => $coreSeller['id'],
                        'is_active' => 1,
                        'code' => 'disco_sandbox',
                        'name' => 'Disco Sandbox',
                        'token' => null,
                        'token_expiration_time' => null,
                        'use_notifications' => 0,
                        'created' => date('Y-m-d H:i:s'),
                        'modified' => date('Y-m-d H:i:s')
                    ]
                ];
                $this->insert('ebay_accounts', $discoEbayAccount);
            }
        }
    }
}
