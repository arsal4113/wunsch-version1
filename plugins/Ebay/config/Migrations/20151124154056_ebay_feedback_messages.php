<?php
use Migrations\AbstractMigration;

class EbayFeedbackMessages extends AbstractMigration
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
        $this->table('ebay_feedback_types')
            ->addColumn('code', 'string', ['limit' => 100])
            ->addColumn('name', 'string', ['limit' => 250])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->create();

        $this->execute("
	   		    INSERT INTO `ebay_feedback_types` (`id`, `code`, `name`, `created`, `modified`) VALUES
	   		      (NULL, 'Positive', 'Positive', NOW(), NOW()),
	   		      (NULL, 'Neutral', 'Neutral', NOW(), NOW()),
	   		      (NULL, 'Negative', 'Negative', NOW(), NOW());
	   	");

        $this->table('ebay_feedback_messages')
            ->addColumn('core_seller_id', 'integer', ['limit' => 10])
            ->addColumn('ebay_account_id', 'integer', ['limit' => 10])
            ->addColumn('ebay_feedback_type_id', 'string', ['limit' => 100])
            ->addColumn('message', 'string', ['limit' => 250])
            ->addColumn('created', 'datetime', ['default' => null, 'limit' => null,	'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addIndex(['core_seller_id'])
            ->addIndex(['ebay_account_id'])
            ->addIndex(['ebay_feedback_type_id'])
            ->create();
    }
}
