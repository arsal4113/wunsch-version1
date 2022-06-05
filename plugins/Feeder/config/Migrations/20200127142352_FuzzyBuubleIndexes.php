<?php

use Migrations\AbstractMigration;

/**
 * Class FuzzyBuubleIndexes
 */
class FuzzyBuubleIndexes extends AbstractMigration
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
        $table = $this->table('feeder_fizzy_bubbles');

        if (!$table->hasIndex(['active'])) {
            $table
                ->addIndex(['active']);
        }

        if (!$table->hasIndex(['use_on'])) {
            $table
                ->addIndex(['use_on']);
        }

        if (!$table->hasIndex(['sort_order'])) {
            $table
                ->addIndex(['sort_order']);
        }

        if (!$table->hasIndex(['start_time'])) {
            $table
                ->addIndex(['start_time']);
        }

        if (!$table->hasIndex(['end_time'])) {
            $table
                ->addIndex(['end_time']);
        }

        $table->update();
    }
}
