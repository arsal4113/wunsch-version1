<?php
use Phinx\Migration\AbstractMigration;

class EbayListingProfileUpdate extends AbstractMigration
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
        $this->execute('ALTER TABLE `ebay_listings` CHANGE `ebay_shipping_profile_name` `ebay_shipping_profile_name` VARCHAR(250) NULL DEFAULT NULL;');
        $this->execute('ALTER TABLE `ebay_listings` CHANGE `ebay_return_profile_name` `ebay_return_profile_name` VARCHAR(250) NULL DEFAULT NULL;');
        $this->execute('ALTER TABLE `ebay_listings` CHANGE `ebay_payment_profile_name` `ebay_payment_profile_name` VARCHAR(250) NULL DEFAULT NULL;');
    }
}
