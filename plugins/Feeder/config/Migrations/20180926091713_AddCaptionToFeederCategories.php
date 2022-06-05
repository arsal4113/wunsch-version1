<?php

use Migrations\AbstractMigration;

class AddCaptionToFeederCategories extends AbstractMigration
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
        $table = $this->table('feeder_categories');
        if (!$table->hasColumn('caption')) {
            $table->addColumn('caption', 'string',
                ['limit' => "1020", 'default' => null, 'null' => true, 'after' => 'name']
            );
        }
        $table->update();
    }
}
