<?php

use Migrations\AbstractMigration;

class CreateFeederHomepagesTable extends AbstractMigration
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
        $table = $this->table('feeder_homepages');
        $table->addColumn('big_banner_image', 'string', [
            'default' => null,
            'limit' => 1020,
            'null' => true,
        ]);
        $table->addColumn('big_banner_link', 'string', [
            'default' => null,
            'limit' => 1020,
            'null' => true,
        ]);
        $table->addColumn('first_small_banner_image', 'string', [
            'default' => null,
            'limit' => 1020,
            'null' => true,
        ]);
        $table->addColumn('first_small_banner_link', 'string', [
            'default' => null,
            'limit' => 1020,
            'null' => true,
        ]);
        $table->addColumn('second_small_banner_image', 'string', [
            'default' => null,
            'limit' => 1020,
            'null' => true,
        ]);
        $table->addColumn('second_small_banner_link', 'string', [
            'default' => null,
            'limit' => 1020,
            'null' => true,
        ]);
        $table->addColumn('surprise_item_ids', 'string', [
            'default' => null,
            'limit' => 2040,
            'null' => true,
        ]);
         $table->addColumn('feeder_category_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addForeignKey('feeder_category_id', 'feeder_categories', 'id', ['delete'=> 'NO ACTION', 'update'=> 'NO ACTION']);
        $table->create();
    }
}
