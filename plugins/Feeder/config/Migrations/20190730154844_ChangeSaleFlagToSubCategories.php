<?php
use Migrations\AbstractMigration;

class ChangeSaleFlagToSubCategories extends AbstractMigration
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
        $table = $this->table('feeder_interest_subcategories')
            ->addColumn('sale_only', 'boolean', ['default' => false]);
        $table->update();


        $table = $this->table('feeder_interests')
            ->removeColumn('sale_only');
        $table->update();
    }
}
