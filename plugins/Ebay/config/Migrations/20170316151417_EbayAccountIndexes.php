<?php
use Migrations\AbstractMigration;

class EbayAccountIndexes extends AbstractMigration
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
        $table = $this->table('ebay_accounts');
        if (!$table->hasIndex(['code'])) {
            $table->addIndex(['code']);
            $table->update();
        }
    }
}
