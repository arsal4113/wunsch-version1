<?php
use Migrations\AbstractMigration;

class AddInterestIdsToJoin extends AbstractMigration
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

        if(!$table->hasColumn('feeder_interest_id')) {
            $table->addColumn('feeder_interest_id', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true
            ]);
        }
        //$table->addForeignKey('feeder_interest_id', 'feeder_interests', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE']);

        $table->update();
    }
}
