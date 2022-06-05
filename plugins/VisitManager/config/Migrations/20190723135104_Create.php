<?php
use Migrations\AbstractMigration;

class Create extends AbstractMigration
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
        $table = $this->table('product_visits');
        $table
            ->addColumn('user_session', 'text', [
                'default' => null,
                'null' => false,
            ])
            ->addColumn('marketplace_product', 'integer', [
                'default' => null,
                'null' => false,
            ])
            ->addColumn('marketplace_name','string', [
                'default' => null,
                'null' => true,
            ])
            ->addColumn('search_term','text', [
                'default' => null,
                'null' => true,
            ])
            ->addColumn('position','integer', [
                'default' => 0,
                'null' => true,
            ])
            ->addColumn('marketplace_category','integer', [
                'default' => null,
                'null' => true,
            ])
            ->addColumn('number_of_reload','integer', [
                'default' => 0,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

    }
}
