<?php
use Migrations\AbstractMigration;

class CorePaymentMethods extends AbstractMigration
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
        $this->table('core_payment_methods')
            ->addColumn('code',         'string',  ['limit' => 100])
            ->addColumn('name',         'string',  ['after' => 'code', 'limit' => 250])
            ->addColumn('is_active',    'boolean', ['after' => 'name'])
            ->addColumn('created',      'datetime', ['after' => 'is_active'])
            ->addColumn('modified',     'datetime', ['after' => 'created'])
            ->create();
    }
}
