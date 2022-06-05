<?php
use Migrations\AbstractMigration;

class AddQuizResultsTable extends AbstractMigration
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
        $this->table('feeder_quiz_results')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true
            ])
            ->addColumn('quiz_description', 'string', [
                'default' => null,
                'limit' => 1020,
                'null' => true
            ])
            ->addColumn('headline', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true
            ])
            ->addColumn('explanation', 'string', [
                'default' => null,
                'limit' => 1020,
                'null' => true
            ])
            ->addColumn('button_text', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true
            ])
            ->addColumn('button_link', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true
            ])
            ->addColumn('image_src', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true
            ])
            ->create();
    }
}
