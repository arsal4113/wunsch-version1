<?php

use Migrations\AbstractMigration;

class AddGenderToHeroItems extends AbstractMigration
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
        if (!$table->hasColumn('gender_id')) {
            $table->addColumn('gender_id', 'integer', ['default' => 1, 'null' => false, 'after' => 'item_image_url'])
                ->addForeignKey('gender_id', 'customer_genders', 'id', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
                ->update();
        }
    }
}
