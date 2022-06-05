<?php

use Migrations\AbstractMigration;

class UpdateProductVisit extends AbstractMigration
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
        if ($table->hasIndex(['catch_logo'])) {
            $table
                ->removeIndex(['catch_logo'])
                ->update();
        }
        $this->table('product_visits')
            ->renameColumn('catch_logo', 'group')
            ->addIndex(['group'])
            ->update();
    }
}
