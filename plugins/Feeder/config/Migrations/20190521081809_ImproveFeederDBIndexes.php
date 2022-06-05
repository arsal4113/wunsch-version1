<?php
use Migrations\AbstractMigration;

class ImproveFeederDBIndexes extends AbstractMigration
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
        if (!$table->hasIndex(['sort_order'])) {
            $table
                ->addIndex(['sort_order'])
                ->update();
        }
    }
}
