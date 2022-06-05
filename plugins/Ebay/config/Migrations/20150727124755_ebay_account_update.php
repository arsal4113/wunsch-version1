<?php
use Phinx\Migration\AbstractMigration;

class EbayAccountUpdate extends AbstractMigration
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
            ->addColumn('token_expiration_time', 'datetime', ['default' => null, 'null' => false, 'after' => 'token'])
            ->update();
    }
}
