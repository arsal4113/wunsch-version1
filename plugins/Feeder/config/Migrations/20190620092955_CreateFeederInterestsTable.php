<?php
use Migrations\AbstractMigration;

class CreateFeederInterestsTable extends AbstractMigration
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
        $this->table('feeder_interests_table')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true
            ])
            ->addColumn('image', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true
            ])
            ->addColumn('sort_order', 'integer', [
                'default' => 0,
                'limit' => 11,
            ])
            ->addColumn('sub_categories', 'string', [
                'default' => null,
                'limit' => 1020,
                'null' => true
            ])
            ->addColumn('sale_only', 'boolean', ['default' => false])
            ->addColumn('gender_id', 'integer', [
                'default' => 1,
                'null' => false,
                'after' => 'item_image_url'
            ])
            ->addForeignKey('gender_id', 'customer_genders', 'id', [
                'delete' => 'NO_ACTION',
                'update' => 'NO_ACTION'
            ])
            ->create();
    }
}
