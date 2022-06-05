<?php

use Feeder\Model\Table\FeederCategoriesTable;
use Migrations\AbstractMigration;

class FeederCategoriesChangeTextType extends AbstractMigration
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

        $this->table('feeder_categories')
            ->changeColumn('include_seller', 'text', ['null' => true, 'default' => null, 'after' => 'items_condition'])
            ->changeColumn('exclude_seller', 'text', ['null' => true, 'default' => null, 'after' => 'include_seller'])
            ->changeColumn('keywords', 'text', ['null' => true, 'default' => null, 'after' => 'gtin'])
            ->changeColumn('seller_account_type', 'string', ['limit' => 20, 'null' => true, 'default' => null, 'after' => 'keywords'])
            ->changeColumn('seller_trusted_level', 'string', ['limit' => 20, 'null' => true, 'default' => null, 'after' => 'seller_account_type'])
            ->changeColumn('listing_type', 'string', ['limit' => 20, 'null' => true, 'default' => null, 'after' => 'seller_trusted_level'])
            ->changeColumn('items_condition', 'string', ['limit' => 20, 'null' => true, 'default' => null, 'after' => 'listing_type'])
            ->changeColumn('gtin', 'string', ['limit' => 20, 'null' => true, 'default' => null, 'after' => 'top_category_id'])
            ->changeColumn('caption', 'text', ['null' => true, 'default' => null])
            ->changeColumn('headline', 'text', ['null' => true, 'default' => null, 'after' => 'url_path'])
            ->changeColumn('url_path', 'text', ['null' => true, 'default' => null, 'after' => 'name'])
            ->changeColumn('ebay_category_id', 'text', ['null' => true, 'default' => null, 'after' => 'random_skip'])
            ->changeColumn('top_category_id', 'text', ['null' => true, 'default' => null, 'after' => 'ebay_category_id'])
            ->changeColumn('banner_small_positions', 'string', ['limit' => 200, 'null' => true, 'default' => '3,16,25,30,46', 'after' => 'banner_products_factor'])
            ->changeColumn('banner_large_positions', 'string', ['limit' => 200, 'null' => true, 'default' => '6,36', 'after' => 'banner_small_positions'])
            ->changeColumn('headline_font_color', 'string', ['limit' => 20, 'null' => true, 'default' => null, 'after' => 'headline'])
            ->changeColumn('caption_font_color', 'string', ['limit' => 20, 'null' => true, 'default' => null, 'after' => 'caption'])
            ->changeColumn('text_background_color', 'string', ['limit' => 20, 'null' => true, 'default' => null, 'after' => 'caption_font_color'])
            ->changeColumn('opacity', 'integer', ['limit' => 3, 'null' => false, 'default' => 100, 'after' => 'text_background_color'])
            ->changeColumn('background_color', 'string', ['limit' => 20, 'null' => true, 'default' => null, 'after' => 'randomize'])
            ->update();
    }
}
