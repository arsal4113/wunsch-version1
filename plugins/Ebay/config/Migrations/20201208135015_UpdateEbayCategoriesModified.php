<?php

use Migrations\AbstractMigration;

class UpdateEbayCategoriesModified extends AbstractMigration
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
        $this->table('ebay_categories')
            ->changeColumn('created', 'datetime', ['default' => null, 'null' => true, 'after' => 'version'])
            ->changeColumn('modified', 'datetime', ['default' => null, 'null' => true, 'after' => 'created'])
            ->update();
    }
}
