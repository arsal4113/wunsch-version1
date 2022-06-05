<?php
use Migrations\AbstractMigration;

class Indexesupdates extends AbstractMigration
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
        $this->table('core_product_updates')
            ->addIndex(['type'])
            ->addIndex(['created'])
            ->save();
    }
}
