<?php

use Migrations\AbstractMigration;

class CreateSessions extends AbstractMigration
{

    public $autoId = false;

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        if (!$this->hasTable('sessions')) {
            $table = $this->table('sessions');
            $table->addColumn('id', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ]);
            $table->addColumn('data', 'text', [
                'default' => null,
                'null' => false,
            ]);
            $table->addColumn('expires', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ]);
            $table->addPrimaryKey([
                'id',
            ]);
            $table->create();
        }

    }
}
