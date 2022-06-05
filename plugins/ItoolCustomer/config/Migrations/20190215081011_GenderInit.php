<?php
use Migrations\AbstractMigration;

class GenderInit extends AbstractMigration
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
        if(!$table->hasColumn('gender')) {
            $table
                ->addColumn('gender', 'string', ['limit' => 100, 'default' => '-', 'null' => false, 'after' => 'core_language_id'])
                ->update();
        }
    }
}
