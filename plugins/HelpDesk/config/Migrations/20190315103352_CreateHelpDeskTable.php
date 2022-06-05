<?php
use Migrations\AbstractMigration;

class CreateHelpDeskTable extends AbstractMigration
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
        $this->table('help_desk_categories')
            ->addColumn('category', 'string', [
                'limit' => '2040',
                'null' => false,
            ])
            ->addColumn('sort_order', 'integer', [
                'default' => 0,
                'limit' => 11,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $table = $this->table('help_desk_faqs');
        $table->addColumn('help_desk_category_id', 'string', [
            'limit' => '2040',
            'null' => false,
        ])
            ->addColumn('question', 'text')
            ->addColumn('answer', 'text')
            ->addColumn('sort_order', 'integer', [
                'default' => 0,
                'limit' => 11,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();
    }
}
