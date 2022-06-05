<?php
use Migrations\AbstractMigration;

class AddUrlFeederHeroItems extends AbstractMigration
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
        if (!$table->hasColumn('url')) {
            $table->addColumn('url', 'string', ['limit' => 1024, 'null' => true, 'default' => null, 'after' => 'item_id'])->update();
        }

        if ($table->hasColumn('item_id')) {
            $table->changeColumn('item_id', 'string', ['limit' => 510, 'null' => true, 'default' => null])->update();
        }
    }
}
