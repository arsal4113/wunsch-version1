<?php
use Migrations\AbstractMigration;

class CancelReasons extends AbstractMigration
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
        $check = $this->fetchRow('SELECT id FROM core_cancel_reasons WHERE code = "buyer_not_paid"');
        if(empty($check)) {
            $this->execute(" INSERT INTO `core_cancel_reasons` (`id`, `core_seller_id`, `code`, `name`, `created`, `modified`) VALUES
              (NULL, 0, 'buyer_not_paid', 'Nicht bezahlt', NOW(), NOW());
        ");
        }

        $check = $this->fetchRow('SELECT id FROM core_cancel_reasons WHERE code = "buyer_purchase_mistake"');
        if(empty($check)) {
            $this->execute(" INSERT INTO `core_cancel_reasons` (`id`, `core_seller_id`, `code`, `name`, `created`, `modified`) VALUES
              (NULL, 0, 'buyer_purchase_mistake', 'Irrtum Kauf', NOW(), NOW());
        ");
        }

        $check = $this->fetchRow('SELECT id FROM core_cancel_reasons WHERE code = "buyer_no_longer_wants_item"');
        if(empty($check)) {
            $this->execute(" INSERT INTO `core_cancel_reasons` (`id`, `core_seller_id`, `code`, `name`, `created`, `modified`) VALUES
              (NULL, 0, 'buyer_no_longer_wants_item', 'Artikel zurückgegeben', NOW(), NOW());
        ");
        }

        $check = $this->fetchRow('SELECT id FROM core_cancel_reasons WHERE code = "seller_out_of_stock"');
        if(empty($check)) {
            $this->execute(" INSERT INTO `core_cancel_reasons` (`id`, `core_seller_id`, `code`, `name`, `created`, `modified`) VALUES
			  (NULL, 0, 'seller_out_of_stock', 'Artikel nicht verfügbar', NOW(), NOW());
        ");
        }

    }
}
