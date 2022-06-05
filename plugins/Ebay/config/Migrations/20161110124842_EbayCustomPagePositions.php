<?php
use Migrations\AbstractMigration;

class EbayCustomPagePositions extends AbstractMigration
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
        if(!$this->hasTable('ebay_custom_page_positions')){
            $table = $this->table('ebay_custom_page_positions');
            $table->addColumn('position', 'string', ['limit' => 255,'default' => null, 'null' => true])
                  ->addColumn('created', 'datetime', ['default' => null, 'null' => true])
                  ->addColumn('modified', 'datetime', ['default' => null, 'null' => true])
                  ->save();
        }
        if($this->hasTable('ebay_custom_page_positions')){
            $rows = [
                [
                    'id' => '1',
                    'position' => 'footer'
                ],
                [
                    'id' => '2',
                    'position' => 'header'
                ]
            ];
            $this->insert('ebay_custom_page_positions', $rows);
        }
    }
}
