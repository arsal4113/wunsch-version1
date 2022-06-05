<?php
use Phinx\Migration\AbstractMigration;

class EbayCleanUp extends AbstractMigration
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
        $table = $this->table('ebay_sites');
        $table->addColumn('name', 'string', ['default' => null, 'limit' => 250, 'null' => false, 'after' => 'id'])
            ->removeColumn('core_marketplace_id')
                ->update();
    }
}
