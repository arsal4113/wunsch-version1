<?php
use Migrations\AbstractMigration;

class AddMiniCartFeederLink extends AbstractMigration
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
        $this->table('feeder_homepages')->addColumn('mini_cart_feeder_category_id', 'integer', ['default' => null, 'null' => true, 'after' => 'feeder_Category_id'])->update();
    }
}
