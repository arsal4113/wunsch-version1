<?php
use Migrations\AbstractMigration;

class AddHeroItemsIsActiveFlag extends AbstractMigration
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
        $table = $this->table('feeder_hero_items');

        if(!$table->hasColumn('is_active')) {
            $table->addColumn('is_active', 'boolean', ['null' => true, 'after' => 'item_id', 'default' => 1]);
        }

        $table->update();
    }
}
