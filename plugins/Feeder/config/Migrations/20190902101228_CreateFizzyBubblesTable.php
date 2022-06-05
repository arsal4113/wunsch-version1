<?php
use Migrations\AbstractMigration;

class CreateFizzyBubblesTable extends AbstractMigration
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
        $this->table('feeder_fizzy_bubbles')
            ->addColumn('url', 'string', [
                'default' => null,
                'limit' => 1020,
                'null' => true
            ])
            ->addColumn('title_text', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true
            ])
            ->addColumn('title_color', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true
            ])
            ->addColumn('title_opacity', 'integer', [
                'default' => 100,
                'limit' => 100,
                'null' => false
            ])
            ->addColumn('subline_text', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true
            ])
            ->addColumn('subline_color', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true
            ])
            ->addColumn('subline_opacity', 'integer', [
                'default' => 100,
                'limit' => 100,
                'null' => false
            ])
            ->addColumn('image_src', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true
            ])
            ->addColumn('sort_order', 'string', [
                'default' => 0,
                'limit' => 20
            ])
            ->addColumn('start_time', 'datetime', [
                'default' => null,
                'null' => true
            ])
            ->addColumn('end_time', 'datetime', [
                'default' => null,
                'null' => true
            ])
            ->create();
    }
}
