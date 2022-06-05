<?php
use Migrations\AbstractMigration;

class AddTopCategory extends AbstractMigration
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

        if (!$table->hasColumn('top_category_id')) {
            $table->addColumn('top_category_id', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
                'after' => 'ebay_category_id'
            ])->update();
        }
    }
}
