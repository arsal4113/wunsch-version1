<?php
use Migrations\AbstractMigration;

class AddEbayAccountCode extends AbstractMigration
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
            ->addColumn('code', 'string', ['limit' => 250,  'after' => 'is_active'])
            ->update();
    }
}
