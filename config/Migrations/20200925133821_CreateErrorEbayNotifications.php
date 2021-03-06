<?php

use Migrations\AbstractMigration;

class CreateErrorEbayNotifications extends AbstractMigration
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
        if (!$this->hasTable('core_error_ebay_notifications')) {
            $table = $this->table('core_error_ebay_notifications')
            ->addColumn('name', 'string', ['limit' => 250])
            ->addColumn('email', 'string', ['limit' => 250])
            ->addColumn('is_active', 'boolean')
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->create();
        }

    }
}
