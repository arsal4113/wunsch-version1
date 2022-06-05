<?php

namespace App\Test\Fixture;

use Cake\Core\Configure;
use Cake\TestSuite\Fixture\TestFixture;
use Cake\Datasource\ConnectionManager;
/**
 * EbayFashionCrossSellingCategoriesFixture
 *
 */
class EbayCheckoutSessionItemFixture extends TestFixture
{
    public $connection = 'test';
    public $import = [
        'table' => 'ebay_checkout_session_items',
        'connection' => 'default'
    ];
    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => '1','ebay_checkout_session_id' => '1','selected_ebay_checkout_session_item_shipping_id' => '1','title' => 'Frauen Baumwollmischung Socken Avocado / Kuchen / Sushi / Apfel / Toast / D E7Z9','short_description' => 'New with tags, #9','base_price_currency' => 'EUR','base_price_value' => '1.8300','original_price_value' => NULL,'image' => 'https://i.ebayimg.com/00/s/MTAwMVgxMDAx/z/VUgAAOSwBSxbBmaH/$_3.JPG','ebay_item_id' => 'v1|372315975605|641139695655','ebay_category_path' => 'Kleidung & Accessoires|Damenmode|Socken & Strümpfe|Socken','top_rated_buying_experience' => NULL,'ebay_line_item_id' => '420002','legacy_order_id' => NULL,'net_price_currency' => 'EUR','net_price_value' => '1.8300','quantity' => '1','seller_username' => 'leihuyoumechenger','seller_account_type' => NULL,'seller_feedback_score' => NULL,'seller_feedback_percentage' => NULL,'attributes' => 'a:1:{s:6:"Styles";s:2:"#9";}','tags' => NULL,'is_deleted' => '0','modified' => '2019-09-05 17:04:53','created' => '2019-09-05 15:21:45'
        ],
    ];
}
