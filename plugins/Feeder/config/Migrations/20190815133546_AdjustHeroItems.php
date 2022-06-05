<?php

use Migrations\AbstractMigration;

class AdjustHeroItems extends AbstractMigration
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
        $this->table('feeder_hero_items')
            ->addColumn('title', 'string', ['null' => true, 'default' => null, 'after' => 'type'])
            ->addColumn('category_id', 'integer', ['null' => true, 'default' => true, 'after' => 'title'])
            ->update();
    }
}
