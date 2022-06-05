<?php
use Migrations\AbstractMigration;

class FeederHeroItemsFeederCategories extends AbstractMigration
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
        $table = $this->table('feeder_categories_feeder_hero_items');

        $table->addColumn('feeder_category_id', 'integer');
        $table->addColumn('feeder_hero_item_id', 'integer');

        $table->addForeignKey('feeder_category_id', 'feeder_categories', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE']);
        $table->addForeignKey('feeder_hero_item_id', 'feeder_hero_items', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE']);
        
        $table->create();
    }
}
