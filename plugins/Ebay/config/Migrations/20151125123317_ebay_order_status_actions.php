<?php
use Migrations\AbstractMigration;

class EbayOrderStatusActions extends AbstractMigration
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
        $this->table('ebay_actions')
            ->addColumn('code', 'string', ['limit' => 100])
            ->addColumn('name', 'string', ['limit' => 250])
            ->addColumn('is_active', 'boolean')
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->create();

        $this->query('INSERT INTO `ebay_actions` (`id`, `code`, `name`, `is_active`, `created`, `modified`) VALUES
            (NULL, "leaveFeedback", "Leave eBay Feedback", 1, NOW(), NOW());
        ');

        $this->table('ebay_order_status_actions')
            ->addColumn('name', 'string', ['limit' => 250])
            ->addColumn('core_seller_id', 'integer', ['limit' => 10])
            ->addColumn('ebay_account_id', 'integer', ['limit' => 10])
            ->addColumn('core_order_status_id', 'integer', ['limit' => 10])
            ->addColumn('core_order_state_id', 'integer', ['limit' => 10])
            ->addColumn('ebay_action_id', 'integer', ['limit' => 10])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addIndex(['core_seller_id'])
            ->addIndex(['ebay_account_id'])
            ->addIndex(['core_order_status_id'])
            ->addIndex(['core_order_state_id'])
            ->addIndex(['ebay_action_id'])
            ->create();
    }
}
