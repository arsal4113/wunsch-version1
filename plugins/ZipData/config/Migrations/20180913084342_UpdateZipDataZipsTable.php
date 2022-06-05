<?php

use Migrations\AbstractMigration;

class UpdateZipDataZipsTable extends AbstractMigration
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
        $table = $this->table('zip_data_zips');
        if (!$table->hasColumn('last_import')) {
            $table
                ->addColumn('last_import', 'integer', ['limit' => 10])
                ->addIndex(['last_import'])
                ->update();
        }
        if (!$table->hasColumn('search_hash')) {
            $table
                ->addColumn('search_hash', 'string', ['limit' => 250])
                ->addIndex(['search_hash'])
                ->update();
        }
        $this->execute('ALTER TABLE zip_data_zips CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    }
}
