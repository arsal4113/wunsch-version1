<?php
use Migrations\AbstractMigration;

class AddRandomizedItemIds extends AbstractMigration
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
        if(!$table->hasColumn('randomize_surprise_item_ids')) {
            $table
                ->addColumn('randomize_surprise_item_ids', 'boolean', ['default' => null, 'null' => true,  'after' => 'surprise_item_ids'])
                ->update();
        }
    }
}
