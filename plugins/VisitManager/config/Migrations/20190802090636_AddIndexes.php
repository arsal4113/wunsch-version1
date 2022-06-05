<?php
use Migrations\AbstractMigration;

class AddIndexes extends AbstractMigration
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
        $productVisits = $this->table('product_visits');
        $productVisits
            ->changeColumn('user_session', 'string', [
                'limit' => 200,
                'default' => null,
                 'null' => false,
            ])
            ->changeColumn('marketplace_product', 'string', [
                'limit' => 200,
                'default' => null,
                 'null' => false
            ])
            ->changeColumn('search_term', 'string', [
                'limit' => 200,
                'default' => null,
                 'null' => true
            ])
            ->changeColumn('marketplace_name', 'string', [
                'limit' => 30,
                'default' => null,
                 'null' => true
            ])
            ->addIndex('user_session')
            ->addIndex('marketplace_product')
            ->addIndex('search_term')
            ->addIndex('marketplace_name')
            ->addIndex(['position'])
            ->renameColumn('number_of_reload', 'hits')
            ->save();
    }
}
