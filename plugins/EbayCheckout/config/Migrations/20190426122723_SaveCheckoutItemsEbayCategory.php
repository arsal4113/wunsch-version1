<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use EisSdk\Entity\SearchItemFilter;
use EisSdk\Request\SearchItemsRequest;
use EisSdk\Security\Session;
use Migrations\AbstractMigration;
use Cake\ORM\TableRegistry;

class SaveCheckoutItemsEbayCategory extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up()
    {
        $table = $this->table('ebay_checkout_session_items');
        if (!$table->hasColumn('ebay_category_path')) {
            $table->addColumn('ebay_category_path', 'string', [
                'limit' => 255,
                'default' => null,
                'null' => true,
                'after' => 'ebay_item_id'
            ])
                ->addIndex(['ebay_category_path'])
                ->update();
        }
        if ($table->hasColumn('ebay_category_id')) {
            $table
                ->removeIndex(['ebay_category_id'])
                ->removeColumn('ebay_category_id')
                ->update();
        }
    }

    public function down()
    {
    }
}
