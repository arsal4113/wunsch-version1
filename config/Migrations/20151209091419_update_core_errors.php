<?php
use Migrations\AbstractMigration;

class UpdateCoreErrors extends AbstractMigration
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
        $this->table('core_errors')
            ->addColumn('code', 'string', ['limit' => 100, 'after' => 'type'])
            ->renameColumn('sub_type', 'sub_code')
            ->update();


    }
}
