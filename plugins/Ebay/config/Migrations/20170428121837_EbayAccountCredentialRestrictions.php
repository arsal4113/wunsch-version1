<?php
use Migrations\AbstractMigration;

class EbayAccountCredentialRestrictions extends AbstractMigration
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

        $table = $this->table('ebay_credential_restrictions');
        if (!$table->exists()) {
            $table
                ->addColumn('ebay_account_type_id', 'integer', ['limit' => 10])
                ->addColumn('core_seller_id', 'integer', ['limit' => 10])
                ->addColumn('ebay_credential_id', 'integer', ['limit' => 10])
                ->addForeignKey('ebay_account_type_id', 'ebay_account_types', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
                ->addForeignKey('core_seller_id', 'core_sellers', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
                ->addForeignKey('ebay_credential_id', 'ebay_credentials', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
                ->create();
        }

        $ebayAccountType = $this->fetchRow('SELECT id FROM ebay_account_types WHERE type ="live"');

        if (isset($ebayAccountType['id']) && is_numeric($ebayAccountType['id'])) {
            $ebayCredentials = [
                [
                    'ebay_account_type_id' => $ebayAccountType['id'],
                    'key_set_name' => 'MediaMarkt/Saturn Production Set',
                    'app_id' => 'iwayssal-etcdevsa-PRD-d69dbd521-463ec05a',
                    'dev_id' => '9a5cf007-56b9-4292-b0cd-8692f4d9604f',
                    'cert_id' => 'PRD-69dbd5215626-6271-406f-b9ef-e20c',
                    'ru_name' => 'i-ways_sales_so-iwayssal-etcdev-lqshwahe',
                    'is_active' => 0
                ],
                [
                    'ebay_account_type_id' => $ebayAccountType['id'],
                    'key_set_name' => 'MediMax Production Set',
                    'app_id' => 'iwayssal-etcdevma-PRD-769e0185b-c0238ff2',
                    'dev_id' => '3191f537-a321-48eb-981d-9047646d41af',
                    'cert_id' => 'PRD-69e0185b97d4-798f-49cf-8721-152a',
                    'ru_name' => 'i-ways_sales_so-iwayssal-etcdev-cslck',
                    'is_active' => 0
                ]
            ];

            $ebayCredentialTable = \Cake\ORM\TableRegistry::get('Ebay.EbayCredentials');
            foreach ($ebayCredentials as $ebayCredential) {
                $credential = $ebayCredentialTable->find()
                    ->where([
                        'app_id' => $ebayCredential['app_id'],
                        'dev_id' => $ebayCredential['dev_id'],
                        'cert_id' => $ebayCredential['cert_id'],
                        'ru_name' => $ebayCredential['ru_name']
                    ])->first();

                if (empty($credential)) {
                    $credential = $ebayCredentialTable->newEntity($ebayCredential);
                    $ebayCredentialTable->save($credential);
                }
            }
        }
    }
}
