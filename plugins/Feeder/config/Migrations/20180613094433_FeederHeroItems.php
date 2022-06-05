<?php

use Migrations\AbstractMigration;

class FeederHeroItems extends AbstractMigration
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
        $table->addColumn('type', 'string', ['limit' => 510, 'null' => false]);
        $table->addColumn('image', 'string', ['limit' => 510, 'null' => true]);
        $table->addColumn('item_id', 'string', ['limit' => 510, 'null' => false]);
        $table->addColumn('sort_order', 'integer', [
            'default' => 0,
            'limit' => 11,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'limit' => null,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'limit' => null,
            'null' => true,
        ]);
        $table->create();
    }
}
