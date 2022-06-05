<?php
use Migrations\AbstractMigration;

class FeederCategoriesSellerTrustedLevel extends AbstractMigration
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

        $table->addColumn('seller_trusted_level', 'string', ['limit' => 510, 'null' => true, 'after' => 'seller_account_type']);

        $table->update();
    }
}
