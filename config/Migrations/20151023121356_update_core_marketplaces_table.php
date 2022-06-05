<?php
use Migrations\AbstractMigration;

class UpdateCoreMarketplacesTable extends AbstractMigration
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
        $this->table('core_marketplaces')
            ->removeColumn('core_currency_id')
            ->update();
    }
}
