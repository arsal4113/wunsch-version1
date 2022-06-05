<?php
use Migrations\AbstractMigration;

class AddInvisibleFlagCatagories extends AbstractMigration
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
        $table = $this->table('feeder_categories');
        if(!$table->hasColumn('is_invisible')) {
            $table->addColumn('is_invisible', 'boolean', ['default' => false, 'after' => 'use_in_search'])
                ->update();
        }
    }
}
