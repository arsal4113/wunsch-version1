<?php
use Migrations\AbstractMigration;

class EbayAccountBugfix extends AbstractMigration
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
        $this->table('ebay_accounts')
            ->changeColumn('created', 'datetime', ['default' => null, 'null' => true])
            ->changeColumn('modified', 'datetime', ['default' => null, 'null' => true])
            ->update();

        $this->table('ebay_accounts_ebay_sites')
            ->removeColumn('created')
            ->removeColumn('modified')
            ->update();
    }
}
