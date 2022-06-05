<?php
use Phinx\Migration\AbstractMigration;

class EbayAccountTypes extends AbstractMigration
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
        $this->table('ebay_account_types')
            ->addColumn('name', 'string', ['default' => null, 'limit' => 250, 'null' => false, 'after' => 'id'])
            ->renameColumn('account_type', 'type')->update();
        $this->dropTable('ebay_account_type_names');
    }
}
