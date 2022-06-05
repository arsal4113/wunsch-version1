<?php
use Migrations\AbstractMigration;

class AddFeederUspBar extends AbstractMigration
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
        $table = $this->table('feeder_usp_bar');

        $table->addColumn('usp_text', 'string', [
            'default' => null,
            'limit' => 510,
            'null' => true,
        ]);

        $table->addColumn('sort_order', 'integer', [
            'default' => 0,
            'limit' => 11,
        ]);

        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'limit' => null,
            'null' => true,
        ]);

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'limit' => null,
            'null' => true,
        ]);

        $table->create();
    }
}
