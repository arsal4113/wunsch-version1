<?php
use Migrations\AbstractMigration;

class FeederInterestsFeederInterestSubcategory extends AbstractMigration
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
        $table = $this->table('feeder_interests_feeder_interest_subcategories');

        $table->addColumn('feeder_interest_id', 'integer');
        $table->addColumn('feeder_interest_subcategory_id', 'integer');

        $table->addForeignKey('feeder_interest_id', 'feeder_interests_table', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE']);
        $table->addForeignKey('feeder_interest_subcategory_id', 'feeder_interest_subcategories', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE']);

        $table->create();
    }
}
