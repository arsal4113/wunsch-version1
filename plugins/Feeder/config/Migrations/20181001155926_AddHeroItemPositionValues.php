<?php
use Migrations\AbstractMigration;

class AddHeroItemPositionValues extends AbstractMigration
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
        $table = $this->table('feeder_categories');

        if(!$table->hasColumn('banner_products_factor')) {
            $table->addColumn('banner_products_factor', 'integer', ['limit' => 11, 'signed' => false, 'null' => true, 'after' => 'title_tag', 'default' => \Feeder\Model\Table\FeederHeroItemsTable::BANNER_PRODUCTS_FACTOR]);
        }

        if(!$table->hasColumn('banner_small_positions')) {
            $table->addColumn('banner_small_positions', 'string', ['default' => implode(',', \Feeder\Model\Table\FeederHeroItemsTable::BANNER_SMALL_POSITIONS), 'limit' => 510, 'null' => true, 'after' => 'banner_products_factor']);
        }

        if (!$table->hasColumn('banner_large_positions')) {
            $table->addColumn('banner_large_positions', 'string', ['default' => implode(',', \Feeder\Model\Table\FeederHeroItemsTable::BANNER_LARGE_POSITIONS), 'limit' => 510, 'null' => true, 'after' => 'banner_small_positions']);
        }

        $table->update();
    }
}
