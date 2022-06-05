<?php
use Migrations\AbstractMigration;

class FeederHomepagesBanners extends AbstractMigration
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
        $table = $this->table('feeder_homepage_banners');

        $table->addColumn('feeder_homepage_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);

        $table->addColumn('banner_image', 'string', [
            'default' => null,
            'limit' => 1020,
            'null' => true,
        ]);

        $table->addColumn('banner_link', 'string', [
            'default' => null,
            'limit' => 1020,
            'null' => true,
        ]);

        $table->addColumn('banner_bp_lg', 'string', [
            'default' => null,
            'limit' => 1020,
            'null' => true,
        ]);

        $table->addColumn('banner_bp_md', 'string', [
            'default' => null,
            'limit' => 1020,
            'null' => true,
        ]);

        $table->addColumn('banner_bp_sm', 'string', [
            'default' => null,
            'limit' => 1020,
            'null' => true,
        ]);

        $table->addColumn('banner_bp_xs', 'string', [
            'default' => null,
            'limit' => 1020,
            'null' => true,
        ]);

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

        $table->addForeignKey('feeder_homepage_id', 'feeder_homepages', 'id', ['delete'=> 'NO ACTION', 'update'=> 'NO ACTION']);
        $table->create();
    }
}
