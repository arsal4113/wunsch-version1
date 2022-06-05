<?php
use Migrations\AbstractMigration;

class EbayTradingApiCalls extends AbstractMigration
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
        $table = $this->table('ebay_trading_api_call_limit_bases');
        if (!$table->exists()) {
            $table
                ->addColumn('code', 'string', ['limit' => 100])
                ->addColumn('name', 'string', ['limit' => 250])
                ->addColumn('created', 'datetime', ['null' => true, 'default' => null])
                ->addColumn('modified', 'datetime', ['null' => true, 'default' => null])
                ->create();
        }

        $table = $this->table('ebay_trading_api_call_types');
        if (!$table->exists()) {
            $table
                ->addColumn('code', 'string', ['limit' => 100])
                ->addColumn('name', 'string', ['limit' => 250])
                ->addColumn('ebay_trading_api_call_limit_base_id', 'integer', ['limit' => 10])
                ->addColumn('limit', 'integer', ['limit' => 10])
                ->addIndex(['code'])
                ->addIndex(['ebay_trading_api_call_limit_base_id'])
                ->addColumn('created', 'datetime', ['null' => true, 'default' => null])
                ->addColumn('modified', 'datetime', ['null' => true, 'default' => null])
                ->create();
        }
        $table = $this->table('ebay_trading_api_calls');
        if (!$table->exists()) {
            $table
                ->addColumn('ebay_trading_api_call_type_id', 'integer', ['limit' => 10])
                ->addColumn('identifier', 'biginteger', ['limit' => 20])
                ->addColumn('ebay_account_id', 'integer', ['limit' => 10])
                ->addColumn('created', 'datetime', ['null' => true, 'default' => null])
                ->addColumn('modified', 'datetime', ['null' => true, 'default' => null])
                ->addIndex(['ebay_trading_api_call_type_id', 'identifier', 'ebay_account_id'], ['name' => 'finder'])
                ->addForeignKey('ebay_trading_api_call_type_id', 'ebay_trading_api_call_types', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
                ->addForeignKey('ebay_account_id', 'ebay_accounts', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
                ->create();
        }

        $data = [
            [
                'code' => 'hour',
                'name' => 'Hourly',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'code' => 'day',
                'name' => 'Daily',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ]
        ];

        $this->insert('ebay_trading_api_call_limit_bases', $data);

        $limitBase = $this->fetchRow('SELECT id FROM ebay_trading_api_call_limit_bases WHERE code ="hour"');

        if(isset($limitBase['id'])) {
            $data = [
                [
                    'code' => 'reviseItem',
                    'name' => 'ReviseItem',
                    'ebay_trading_api_call_limit_base_id' => $limitBase['id'],
                    'limit' => 5,
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'code' => 'reviseFixedPriceItem',
                    'name' => 'ReviseFixedPriceItem',
                    'ebay_trading_api_call_limit_base_id' => $limitBase['id'],
                    'limit' => 5,
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ]
            ];

            $this->insert('ebay_trading_api_call_types', $data);
        }
    }
}
