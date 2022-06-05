<?php
use Migrations\AbstractMigration;

class UpdateSellerType extends AbstractMigration
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
        $this->table('core_seller_types')
            ->addColumn('redirect_url', 'string', ['limit' => 250, 'default' => null, 'null' => true, 'after' => 'name'])
            ->save();
    }
}