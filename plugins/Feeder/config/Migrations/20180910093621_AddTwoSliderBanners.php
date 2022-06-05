<?php

use Migrations\AbstractMigration;

class AddTwoSliderBanners extends AbstractMigration
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
        $table->addColumn('third_small_banner_image', 'string', [
            'default' => null,
            'limit' => 1020,
            'null' => true,
            'after' => 'second_small_banner_link'
        ])->update();
        $table->addColumn('third_small_banner_link', 'string', [
            'default' => null,
            'limit' => 1020,
            'null' => true,
            'after' => 'third_small_banner_image'
        ])->update();
        $table->addColumn('fourth_small_banner_image', 'string', [
            'default' => null,
            'limit' => 1020,
            'null' => true,
            'after' => 'third_small_banner_link'
        ])->update();
        $table->addColumn('fourth_small_banner_link', 'string', [
            'default' => null,
            'limit' => 1020,
            'null' => true,
            'after' => 'fourth_small_banner_image'
        ])->update();
    }
}
