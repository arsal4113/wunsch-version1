<?php

use Migrations\AbstractMigration;

class AddHeroItemsItemImageUrl extends AbstractMigration
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

        if (!$table->hasColumn('item_image_url')) {
            $table->addColumn('item_image_url', 'string', [
                'null' => true,
                'after' => 'item_id',
                'limit' => 510
            ]);
        }

        $table->update();
    }
}
