<?php
use Migrations\AbstractMigration;

class UpdateEbaySites extends AbstractMigration
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
        $this->table('ebay_sites')
            ->addColumn('core_currency_id', 'integer', ['after' => 'core_marketplace_id', 'limit' => 10])
            ->addIndex(['core_currency_id'])
            ->update();
    }
}
