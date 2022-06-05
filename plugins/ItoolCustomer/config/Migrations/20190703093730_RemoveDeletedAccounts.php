<?php
use Migrations\AbstractMigration;

class RemoveDeletedAccounts extends AbstractMigration
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
        $table = $this->table('social_profiles');
        if ($table->hasForeignKey('user_id')) {
            $table->dropForeignKey('user_id')->save();
        }
        $table->addForeignKey('user_id', 'customers', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->save();

        $table = $this->table('newsletters');
        if ($table->hasForeignKey('customer_id')) {
            $table->dropForeignKey('customer_id')->save();
        }
        $table->addForeignKey('customer_id', 'customers', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->save();

        $this->execute('delete from customers where is_deleted = 1');
    }
}
