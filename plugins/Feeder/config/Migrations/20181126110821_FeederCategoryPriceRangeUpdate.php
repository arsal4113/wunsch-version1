<?php
use Migrations\AbstractMigration;

class FeederCategoryPriceRangeUpdate extends AbstractMigration
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
        if($table->hasColumn('price_from')) {
            $table->changeColumn( 'price_from', 'decimal', ['precision' => 8, 'scale' => 2, 'after' => 'use_in_search', 'default' => 1]);
            $table->update();
            $this->execute('UPDATE feeder_categories SET price_from = 1 WHERE price_from = 0');
        }
    }
}
