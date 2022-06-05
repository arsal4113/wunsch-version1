<?php

use Migrations\AbstractMigration;

class UpdateEbayAccountsTableStructure extends AbstractMigration
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
        $table = $this->table('ebay_accounts');
        if (!$table->hasColumn('epn_identifier')) {
            $table->addColumn('epn_identifier', 'string', ['limit' => 100, 'default' => null, 'null' => true, 'after' => 'core_seller_id'])
                ->update();
        }
    }
}
