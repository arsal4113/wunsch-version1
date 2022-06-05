<?php
use Migrations\AbstractMigration;

class AddStateToAddress extends AbstractMigration
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
        $table = $this->table('customer_addresses');
        if ($table->exists()) {
            $table
                ->addColumn('state', 'string', ['limit' => 200, 'after' => 'city'])
                ->update();
        }
    }
}
