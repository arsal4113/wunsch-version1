<?php

namespace Feeder\Test\TestCase\Controller;

use Feeder\Controller\FeederCategoriesController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Core\Configure;
use Cake\Cache\Cache;

/**
 * Feeder\Controller\FeederCategoriesController Test Case
 */
class FeederCategoriesControllerTest extends IntegrationTestCase
{
    use IntegrationTestTrait;
    use GenerateCoreUserEntity;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Core/CoreUsers',
        'app.Core/CoreSellers',
        'app.Core/CoreSellerTypes',
        'app.Core/CoreUserRoles',
        'app.Core/CoreLanguages',
        'app.Core/CoreUserRolesCoreUsers',
        'app.Acos/Aros',
        'app.Acos/Acos',
        'app.Acos/AcosAros',
        'app.Core/CoreCountries',
        'app.Core/CoreConfigurations',
        'app.FeederGuides',
        'plugin.feeder.FeederCategories',
        'app.FeederCategoriesFeederHeroItems',
        'app.FeederGuidesFeederCategories',
        'plugin.feeder.FeederCategoriesCoreCountries',
        'plugin.feeder.FeederCategoriesVideoElements',
        'app.Core/TranslationCoreCountries',
        'app.UrlRewriteRoutes',
        'plugin.UrlRewrite.UrlRewriteRedirectTypes',
        'plugin.UrlRewrite.UrlRewriteRedirects',
        'plugin.EbayCheckout.EbayCheckoutSessionItems',
        'plugin.EbayCheckout.EbayCheckoutSessions',
    ];
    const CURRENT_URL = '/feeder/feeder-categories';
    private $coreUser;

    public static function setUpBeforeClass()
    {
        Configure::write('Acl.database', 'test');
    }

    public function setup()
    {
        Cache::drop('api_user');
        $this->coreUser = $this->setLogin('test');
        $this->session([
            'Auth' => [
                'User' => $this->coreUser
            ]
        ]);
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        //dd(1);
        $this->get(self::CURRENT_URL);
        $this->assertResponseOk();
    }

    public function testIndexEmpty()
    {
        //dd(1);
        $this->get(self::CURRENT_URL . '/index?target_url=test');
        $this->assertResponseOk();
    }

    public function testView()
    {
        $this->get(self::CURRENT_URL . '/view/1');
        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id'                     => '40',
            'parent_id'              => '38',
            'lft'                    => '2',
            'rght'                   => '3',
            'level'                  => '1',
            'name'                   => 'Beliebt',
            'category_type'          => 'Article Ids',
            'template_type'          => 'Template A',
            'url_path'               => 'beliebt',
            'headline'               => 'Beliebt',
            'headline_guide'         => NULL,
            'headline_font_color'    => NULL,
            'caption'                => NULL,
            'caption_font_color'     => NULL,
            'text_background_color'  => NULL,
            'opacity'                => '100',
            'item_id'                => '',
            'image'                  => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'uploaded_image_size'    => NULL,
            'image_alt_tag'          => '',
            'image_title_tag'        => '',
            'image_selected'         => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/belebt.svg',
            'background'             => NULL,
            'background_alt_tag'     => '',
            'background_title_tag'   => '',
            'randomize'              => NULL,
            'sort_by_input_sequence' => '0',
            'background_color'       => '',
            'random_skip'            => NULL,
            'ebay_category_id'       => '3205;25800;25799;20725;11700;155344;63861;62107;31774;172016;60889;7689;58730;180925;21022;172032;182101;172020;172027;107956;36413;36409;1882951;172023;178961;112562;107876;53159;11514;63862;11554;63861;63864;62107;95672;53557;179247;169291;166030;58540;80077;123422;123417;20349;20349;35190;67870;51071;175677;18871;30093;15230;31388;158927;179798;72891;181395;106983;177832;1105;171219;11104;3957;62429;62424;31387;155101;32050;28162;31401;41990;31723;146290;160667;177791;146247;159889;38227;36027;20652;57', 'top_category_id' => 1, 'gtin' => '', 'keywords' => '', 'exclude_keywords' => NULL, 'seller_account_type' => 'BUSINESS', 'seller_trusted_level' => '', 'min_feedback_score' => '0', 'listing_type' => 'FIXED_PRICE', 'items_condition' => '1000', 'include_seller' => '', 'exclude_seller' => '', 'min_price' => NULL, 'max_price' => NULL, 'sort_order' => '0', 'use_in_search' => '1', 'is_invisible' => '0', 'has_animated_header' => '0', 'animated_header_custom_style' => NULL, 'animated_header_text_title' => NULL, 'animated_header_text_title_color' => NULL, 'animated_header_text_subtitle' => NULL, 'animated_header_first_background_color' => NULL, 'animated_header_second_background_color' => NULL, 'animated_header_third_background_color' => NULL, 'animated_header_image' => NULL, 'animated_header_background_animation_type' => NULL, 'animated_header_end_time' => NULL, 'animated_header_end_time_color' => NULL, 'animated_header_name_color' => NULL, 'animated_header_box_color' => NULL, 'animated_header_number_color' => NULL, 'animated_header_tile_color' => NULL, 'animated_header_text_subtitle_color' => NULL, 'banner_image' => NULL, 'banner_image_alt_tag' => NULL, 'banner_image_title_tag' => NULL, 'banner_url' => '', 'price_from' => '1.00', 'price_to' => '20.00', 'only_with_sales_prices' => '0', 'modified' => '2019-08-26 17:27:19', 'created' => '2018-05-29 21:50:13', 'meta_description' => '', 'footer_text' => NULL, 'facebook_og_url' => NULL, 'facebook_og_type' => NULL, 'facebook_og_title' => NULL, 'facebook_og_description' => NULL, 'facebook_og_image' => NULL, 'start_time' => NULL, 'end_time' => NULL, 'title_tag' => 'Beliebt', 'robot_tag' => NULL, 'feeder_categories_video_element_id' => NULL, 'canonical_link_category_id' => NULL, 'banner_products_factor' => '60', 'banner_small_positions' => '3,16,25,30,46', 'banner_large_positions' => '6,36',
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $feeder_cats = TableRegistry::getTableLocator()->get('FeederCategories');
        $query       = $feeder_cats->find()->where(['id' => $data['id']]);
        $this->assertEquals(1, $query->count());
    }

    public function testAddGoogle()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id' => '40', 'parent_id' => '38', 'lft' => '2', 'rght' => '3', 'level' => '1', 'name' => 'Beliebt', 'category_type' => 'Article Ids', 'template_type' => 'Template A', 'url_path' => 'beliebt', 'headline' => 'Beliebt', 'headline_guide' => NULL, 'headline_font_color' => NULL, 'caption' => NULL, 'caption_font_color' => NULL, 'text_background_color' => NULL, 'opacity' => '100', 'item_id' => '', 'image' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg', 'uploaded_image_size' => NULL, 'image_alt_tag' => '', 'image_title_tag' => '', 'image_selected' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/belebt.svg', 'background' => NULL, 'background_alt_tag' => '', 'background_title_tag' => '', 'randomize' => NULL, 'sort_by_input_sequence' => '0', 'background_color' => '', 'random_skip' => NULL, 'ebay_category_id' => '3205;25800;25799;20725;11700;155344;63861;62107;31774;172016;60889;7689;58730;180925;21022;172032;182101;172020;172027;107956;36413;36409;1882951;172023;178961;112562;107876;53159;11514;63862;11554;63861;63864;62107;95672;53557;179247;169291;166030;58540;80077;123422;123417;20349;20349;35190;67870;51071;175677;18871;30093;15230;31388;158927;179798;72891;181395;106983;177832;1105;171219;11104;3957;62429;62424;31387;155101;32050;28162;31401;41990;31723;146290;160667;177791;146247;159889;38227;36027;20652;57', 'top_category_id' => 1, 'gtin' => '', 'keywords' => '', 'exclude_keywords' => NULL, 'seller_account_type' => 'BUSINESS', 'seller_trusted_level' => '', 'min_feedback_score' => '0', 'listing_type' => 'FIXED_PRICE', 'items_condition' => '1000', 'include_seller' => '', 'exclude_seller' => '', 'min_price' => NULL, 'max_price' => NULL, 'sort_order' => '0', 'use_in_search' => '1', 'is_invisible' => '0', 'has_animated_header' => '0', 'animated_header_custom_style' => NULL, 'animated_header_text_title' => NULL, 'animated_header_text_title_color' => NULL, 'animated_header_text_subtitle' => NULL, 'animated_header_first_background_color' => NULL, 'animated_header_second_background_color' => NULL, 'animated_header_third_background_color' => NULL, 'animated_header_image' => NULL, 'animated_header_background_animation_type' => NULL, 'animated_header_end_time' => NULL, 'animated_header_end_time_color' => NULL, 'animated_header_name_color' => NULL, 'animated_header_box_color' => NULL, 'animated_header_number_color' => NULL, 'animated_header_tile_color' => NULL, 'animated_header_text_subtitle_color' => NULL, 'banner_image' => NULL, 'banner_image_alt_tag' => NULL, 'banner_image_title_tag' => NULL, 'banner_url' => '', 'price_from' => '1.00', 'price_to' => '20.00', 'only_with_sales_prices' => '0', 'modified' => '2019-08-26 17:27:19', 'created' => '2018-05-29 21:50:13', 'meta_description' => '', 'footer_text' => NULL, 'facebook_og_url' => NULL, 'facebook_og_type' => NULL, 'facebook_og_title' => NULL, 'facebook_og_description' => NULL, 'facebook_og_image' => NULL, 'start_time' => NULL, 'end_time' => NULL, 'title_tag' => 'Beliebt', 'robot_tag' => NULL, 'feeder_categories_video_element_id' => NULL, 'canonical_link_category_id' => NULL, 'banner_products_factor' => '60', 'banner_small_positions' => '3,16,25,30,46', 'banner_large_positions' => '6,36',
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $feeder_cats = TableRegistry::getTableLocator()->get('FeederCategories');
        $query       = $feeder_cats->find()->where(['id' => $data['id']]);
        $this->assertEquals(1, $query->count());
    }

    public function testAddFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
    }

    public function testAddView()
    {
        $this->get(self::CURRENT_URL . '/add');
        $this->assertResponseSuccess();
    }

    public function testEdit()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id' => '40', 'parent_id' => '38', 'lft' => '2', 'rght' => '3', 'level' => '1', 'name' => 'Beliebt', 'category_type' => 'Article Ids', 'template_type' => 'Template A', 'url_path' => 'beliebt', 'headline' => 'Beliebt', 'headline_guide' => NULL, 'headline_font_color' => NULL, 'caption' => NULL, 'caption_font_color' => NULL, 'text_background_color' => NULL, 'opacity' => '100', 'item_id' => '', 'image' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg', 'uploaded_image_size' => NULL, 'image_alt_tag' => '', 'image_title_tag' => '', 'image_selected' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/belebt.svg', 'background' => NULL, 'background_alt_tag' => '', 'background_title_tag' => '', 'randomize' => NULL, 'sort_by_input_sequence' => '0', 'background_color' => '', 'random_skip' => NULL, 'ebay_category_id' => '3205;25800;25799;20725;11700;155344;63861;62107;31774;172016;60889;7689;58730;180925;21022;172032;182101;172020;172027;107956;36413;36409;1882951;172023;178961;112562;107876;53159;11514;63862;11554;63861;63864;62107;95672;53557;179247;169291;166030;58540;80077;123422;123417;20349;20349;35190;67870;51071;175677;18871;30093;15230;31388;158927;179798;72891;181395;106983;177832;1105;171219;11104;3957;62429;62424;31387;155101;32050;28162;31401;41990;31723;146290;160667;177791;146247;159889;38227;36027;20652;57', 'top_category_id' => 1, 'gtin' => '', 'keywords' => '', 'exclude_keywords' => NULL, 'seller_account_type' => 'BUSINESS', 'seller_trusted_level' => '', 'min_feedback_score' => '0', 'listing_type' => 'FIXED_PRICE', 'items_condition' => '1000', 'include_seller' => '', 'exclude_seller' => '', 'min_price' => NULL, 'max_price' => NULL, 'sort_order' => '0', 'use_in_search' => '1', 'is_invisible' => '0', 'has_animated_header' => '0', 'animated_header_custom_style' => NULL, 'animated_header_text_title' => NULL, 'animated_header_text_title_color' => NULL, 'animated_header_text_subtitle' => NULL, 'animated_header_first_background_color' => NULL, 'animated_header_second_background_color' => NULL, 'animated_header_third_background_color' => NULL, 'animated_header_image' => NULL, 'animated_header_background_animation_type' => NULL, 'animated_header_end_time' => NULL, 'animated_header_end_time_color' => NULL, 'animated_header_name_color' => NULL, 'animated_header_box_color' => NULL, 'animated_header_number_color' => NULL, 'animated_header_tile_color' => NULL, 'animated_header_text_subtitle_color' => NULL, 'banner_image' => NULL, 'banner_image_alt_tag' => NULL, 'banner_image_title_tag' => NULL, 'banner_url' => '', 'price_from' => '1.00', 'price_to' => '20.00', 'only_with_sales_prices' => '0', 'modified' => '2019-08-26 17:27:19', 'created' => '2018-05-29 21:50:13', 'meta_description' => '', 'footer_text' => NULL, 'facebook_og_url' => NULL, 'facebook_og_type' => NULL, 'facebook_og_title' => NULL, 'facebook_og_description' => NULL, 'facebook_og_image' => NULL, 'start_time' => NULL, 'end_time' => NULL, 'title_tag' => 'Beliebt', 'robot_tag' => NULL, 'feeder_categories_video_element_id' => NULL, 'canonical_link_category_id' => NULL, 'banner_products_factor' => '60', 'banner_small_positions' => '3,16,25,30,46', 'banner_large_positions' => '6,36',
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $feeder_cats = TableRegistry::getTableLocator()->get('FeederCategories');
        $feeder_cat  = $feeder_cats->find()->where(['name' => $data['name']])->first();
        $this->assertEquals($data['name'], $feeder_cat->name);
    }

    public function testEditFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'id' => null, 'parent_id' => null, 'lft' => '2', 'rght' => '3', 'level' => '1', 'name' => 'Beliebt', 'category_type' => 'Article Ids', 'template_type' => 'Template A', 'url_path' => 'beliebt', 'headline' => 'Beliebt', 'headline_guide' => NULL, 'headline_font_color' => NULL, 'caption' => NULL, 'caption_font_color' => NULL, 'text_background_color' => NULL, 'opacity' => '100', 'item_id' => '', 'image' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg', 'uploaded_image_size' => NULL, 'image_alt_tag' => '', 'image_title_tag' => '', 'image_selected' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/belebt.svg', 'background' => NULL, 'background_alt_tag' => '', 'background_title_tag' => '', 'randomize' => NULL, 'sort_by_input_sequence' => '0', 'background_color' => '', 'random_skip' => NULL, 'ebay_category_id' => '3205;25800;25799;20725;11700;155344;63861;62107;31774;172016;60889;7689;58730;180925;21022;172032;182101;172020;172027;107956;36413;36409;1882951;172023;178961;112562;107876;53159;11514;63862;11554;63861;63864;62107;95672;53557;179247;169291;166030;58540;80077;123422;123417;20349;20349;35190;67870;51071;175677;18871;30093;15230;31388;158927;179798;72891;181395;106983;177832;1105;171219;11104;3957;62429;62424;31387;155101;32050;28162;31401;41990;31723;146290;160667;177791;146247;159889;38227;36027;20652;57', 'top_category_id' => 1, 'gtin' => '', 'keywords' => '', 'exclude_keywords' => NULL, 'seller_account_type' => 'BUSINESS', 'seller_trusted_level' => '', 'min_feedback_score' => '0', 'listing_type' => 'FIXED_PRICE', 'items_condition' => '1000', 'include_seller' => '', 'exclude_seller' => '', 'min_price' => NULL, 'max_price' => NULL, 'sort_order' => '0', 'use_in_search' => '1', 'is_invisible' => '0', 'has_animated_header' => '0', 'animated_header_custom_style' => NULL, 'animated_header_text_title' => NULL, 'animated_header_text_title_color' => NULL, 'animated_header_text_subtitle' => NULL, 'animated_header_first_background_color' => NULL, 'animated_header_second_background_color' => NULL, 'animated_header_third_background_color' => NULL, 'animated_header_image' => NULL, 'animated_header_background_animation_type' => NULL, 'animated_header_end_time' => NULL, 'animated_header_end_time_color' => NULL, 'animated_header_name_color' => NULL, 'animated_header_box_color' => NULL, 'animated_header_number_color' => NULL, 'animated_header_tile_color' => NULL, 'animated_header_text_subtitle_color' => NULL, 'banner_image' => NULL, 'banner_image_alt_tag' => NULL, 'banner_image_title_tag' => NULL, 'banner_url' => '', 'price_from' => '1.00', 'price_to' => '20.00', 'only_with_sales_prices' => '0', 'modified' => '2019-08-26 17:27:19', 'created' => '2018-05-29 21:50:13', 'meta_description' => '', 'footer_text' => NULL, 'facebook_og_url' => NULL, 'facebook_og_type' => NULL, 'facebook_og_title' => NULL, 'facebook_og_description' => NULL, 'facebook_og_image' => NULL, 'start_time' => NULL, 'end_time' => NULL, 'title_tag' => 'Beliebt', 'robot_tag' => NULL, 'feeder_categories_video_element_id' => NULL, 'canonical_link_category_id' => NULL, 'banner_products_factor' => '60', 'banner_small_positions' => '3,16,25,30,46', 'banner_large_positions' => '6,36',
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
    }

    public function testEditView()
    {
        $this->get(self::CURRENT_URL . '/edit/1');
        $this->assertResponseSuccess();
    }

    public function testDelete()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post(self::CURRENT_URL . '/delete/1');
        $this->assertResponseSuccess();
    }

    public function testDownload()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [];
        $this->post(self::CURRENT_URL . '/download', $data);
        $this->assertResponseSuccess();
    }
}
