<?php
use Migrations\AbstractMigration;

class AddNewIndexes extends AbstractMigration
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
        $this->table('product_visits')
            ->addIndex(['catch_logo'])
            ->update();
    }
}
