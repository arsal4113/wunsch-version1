<?php

use Phinx\Migration\AbstractMigration;

class UpdateEbayLaunchProfiles extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function change()
    {
        $table = $this->table('ebay_launch_profiles');
        $table->renameColumn('launch_quantity', 'max_quantity');
        $table->renameColumn('item_location', 'location_city');
        $table->renameColumn('item_postal_code', 'location_postal_code');
        $table->renameColumn('item_country', 'location_country');
        $table->removeColumn('use_second_category');
        $table->addColumn('ebay_shipping_profile_id', 'string', ['limit' => 20, 'default' => null, 'null' => false, 'after' => 'location_country']);
        $table->addColumn('ebay_return_profile_id', 'string', ['limit' => 20, 'default' => null, 'null' => false, 'after' => 'ebay_shipping_profile_id']);
        $table->addColumn('ebay_payment_profile_id', 'string', ['limit' => 20, 'default' => null, 'null' => false, 'after' => 'ebay_return_profile_id']);
        $table->update();
    }
}
