<?php
use Migrations\AbstractMigration;

class CustomersFeederInterestSubcategories extends AbstractMigration
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
        $table = $this->table('customers_feeder_interest_subcategories');

        $table->addColumn('customer_id', 'integer');
        $table->addColumn('feeder_interest_subcategory_id', 'integer');

        $table->addForeignKey('customer_id', 'customers', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE']);
        $table->addForeignKey('feeder_interest_subcategory_id', 'feeder_interest_subcategories', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE']);

        $table->create();
    }
}
