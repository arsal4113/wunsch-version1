<?php
use Migrations\AbstractMigration;

class CoreProductBatchUpdates extends AbstractMigration
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
        $this->table('core_product_batch_updates')
            ->addColumn('core_seller_id', 'integer', ['limit' => 10])
            ->addColumn('type', 'string', ['limit' => 200])
            ->addColumn('is_processed', 'boolean')
            ->addColumn('is_running', 'boolean')
            ->addColumn('start_time', 'datetime', ['null' => true, 'default' => null])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->addIndex(['core_seller_id'])
            ->addForeignKey('core_seller_id', 'core_sellers', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
            ->create();
    }
}
