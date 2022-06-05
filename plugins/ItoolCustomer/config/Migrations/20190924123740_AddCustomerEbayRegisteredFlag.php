<?php
use Migrations\AbstractMigration;

class AddCustomerEbayRegisteredFlag extends AbstractMigration
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
        $table = $this->table('customers');

        if (!$table->hasColumn('ebay_registered')) {
            $table->addColumn('ebay_registered', 'boolean', ['default' => false, 'after' => 'is_deleted'])
                ->save();
        }
    }
}
