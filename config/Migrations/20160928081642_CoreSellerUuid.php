<?php
use Migrations\AbstractMigration;

class CoreSellerUuid extends AbstractMigration
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
        $this->table('core_sellers')
            ->addColumn('uuid', 'string', ['limit' => 50, 'null' => true, 'after' => 'activation_token'])
            ->update();
    }
}
