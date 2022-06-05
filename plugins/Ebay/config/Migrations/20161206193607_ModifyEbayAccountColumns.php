<?php
use Migrations\AbstractMigration;

class ModifyEbayAccountColumns extends AbstractMigration
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
            ->changeColumn('name', 'string', ['limit' => 250, 'after' => 'code'])
            ->update();
    }
}
