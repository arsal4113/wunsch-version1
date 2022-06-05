<?php
use Migrations\AbstractMigration;

class CoreCancelReasons extends AbstractMigration
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
        $this->table('core_cancel_reasons')
            ->addColumn('name', 'string', ['limit' => 250, 'after' => 'code'])
            ->addColumn('core_seller_id', 'integer', ['limit' => 10, 'after' => 'id'])
            ->addIndex(['core_seller_id'])
            ->update();
        if($this->hasTable('core_cancel_reason_names')) {
            $this->dropTable('core_cancel_reason_names');
        }

        $sellers = $this->fetchAll('SELECT id FROM core_sellers');
        if (!empty($sellers)) {
            foreach ($sellers as $seller) {
                $this->execute("
	   		    INSERT INTO `core_cancel_reasons` (`id`, `core_seller_id`, `code`, `name`, `created`, `modified`) VALUES
			      (NULL, " . $seller['id'] . ", 'buyer_not_paid', 'Nicht bezahlt', NOW(), NOW()),
			      (NULL, " . $seller['id'] . ", 'buyer_purchase_mistake', 'Irrtum Kauf', NOW(), NOW()),
			      (NULL, " . $seller['id'] . ", 'buyer_no_longer_wants_item', 'Artikel zurückgegeben', NOW(), NOW()),
			      (NULL, " . $seller['id'] . ", 'seller_out_of_stock', 'Artikel nicht verfügbar', NOW(), NOW());
	   	        ");
            }
        }
    }
}
