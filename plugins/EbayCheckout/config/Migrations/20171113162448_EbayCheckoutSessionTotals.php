<?php
use Migrations\AbstractMigration;

class EbayCheckoutSessionTotals extends AbstractMigration
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
        $this->table('ebay_checkout_session_totals')
            ->addColumn('ebay_checkout_session_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('code', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('label', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('currency', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('value', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('order', 'integer', [
                'default' => 0,
                'null' => true,
            ]) ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'ebay_checkout_session_id',
                ]
            )
            ->create();


        $this->table('ebay_checkout_session_totals')
            ->addForeignKey(
                'ebay_checkout_session_id',
                'ebay_checkout_sessions',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();
    }
}
