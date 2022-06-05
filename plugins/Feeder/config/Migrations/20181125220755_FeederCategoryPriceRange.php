<?php

use Migrations\AbstractMigration;

class FeederCategoryPriceRange extends AbstractMigration
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

        $update = false;

        if (!$table->hasColumn('price_from')) {
            $table->addColumn('price_from', 'decimal', ['precision' => 8, 'scale' => 2, 'after' => 'use_in_search', 'default' => 0]);
            $update = true;
        }

        if (!$table->hasColumn('price_to')) {
            $table->addColumn('price_to', 'decimal', ['precision' => 8, 'scale' => 2, 'after' => 'use_in_search', 'default' => 20]);
            $update = true;
        }

        if ($update) {
            $table->update();
        }
    }
}
