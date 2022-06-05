<?php
use Migrations\AbstractMigration;

class FeederWorlds extends AbstractMigration
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
            $table = $this->table('feeder_worlds');
            $table->addColumn('name', 'string', ['limit' => '510'])
                ->addColumn('image', 'string', ['limit' => '2040'])
                ->addColumn('link', 'string', ['limit' => '2040'])
                ->addColumn('sort_order', 'integer', ['limit' => 10, 'default' => 0])
                ->addColumn('modified', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('created', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->create();
    }
}
