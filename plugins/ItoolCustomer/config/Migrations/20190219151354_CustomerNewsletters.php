<?php
use Migrations\AbstractMigration;

class CustomerNewsletters extends AbstractMigration
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
        $table = $this->table('newsletters');
        if (!$table->exists()) {
            $table->addColumn('customer_id','integer', ['null' => true, 'default' => null, 'limit' => 10]);
            $table->addColumn('email', 'string', ['limit' => 200]);
            $table->addColumn('subscribed', 'boolean', ['default' => 0, 'limit' => 200]);
            $table->addColumn('subscribe_type', 'enum', ['values' => [\ItoolCustomer\Model\Table\NewslettersTable::DAILY, \ItoolCustomer\Model\Table\NewslettersTable::WEEKLY]]);
            $table->addColumn('created', 'datetime', ['default' => null, 'null' => true]);
            $table->addColumn('modified', 'datetime', ['default' => null, 'null' => true]);
            $table->addIndex(['email', 'subscribed']);
            $table->addForeignKey('customer_id', 'customers', 'id');
            $table->create();
        }
    }
}
