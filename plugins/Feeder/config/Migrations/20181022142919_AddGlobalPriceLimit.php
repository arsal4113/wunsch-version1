<?php
use Migrations\AbstractMigration;

class AddGlobalPriceLimit extends AbstractMigration
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
        $table = $this->table('feeder_global_price_limit');
        if (!$table->exists()) {
            $table
                ->addColumn('price_limit', 'decimal', ['precision' => 10, 'scale' => 4, 'null' => false])
                ->addColumn('created', 'datetime', ['null' => true, 'default' => null])
                ->addColumn('modified', 'datetime', ['null' => true, 'default' => null])
                ->create();

            $table->changeColumn('id', 'enum', ['values' => ['1'], 'default' => '1'])->save();

            $global_price = [
                'id' => 1,
                'price_limit' => 20,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ];

            $this->insert('feeder_global_price_limit', $global_price);
        }
    }
}
