<?php

use Migrations\AbstractMigration;

class AddCheckoutSessionItemIsDeletedAndAttributes extends AbstractMigration
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
        $this->table('ebay_checkout_session_items')
            ->addColumn('attributes', 'string', [
                'limit' => 512,
                'null' => true,
                'after' => 'seller_feedback_percentage'
            ])
            ->addColumn('is_deleted', 'boolean', [
                'default' => 0,
                'null' => true,
                'after' => 'attributes'
            ])
            ->addIndex(['is_deleted'])
            ->update();
    }
}
