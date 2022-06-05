<?php

use Migrations\AbstractMigration;

/**
 * Class ModifyNewslettersTable
 */
class ModifyNewslettersTable extends AbstractMigration
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
        $this->table('newsletters')
            ->addColumn('is_exportable', 'integer', ['limit' => 1, 'null' => true, 'default' => null, 'after' => 'subscribe_type'])
            ->addIndex(['is_exportable'])
            ->update();
    }
}
