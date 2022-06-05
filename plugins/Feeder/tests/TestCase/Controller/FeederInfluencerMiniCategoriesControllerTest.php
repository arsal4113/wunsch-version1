<?php

namespace Feeder\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Feeder\Controller\FeederInfluencerMiniCategoriesController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Core\Configure;
use Cake\Cache\Cache;

/**
 * Feeder\Controller\FeederInfluencerMiniCategoriesController Test Case
 *
 * @uses \Feeder\Controller\FeederInfluencerMiniCategoriesController
 */
class FeederInfluencerMiniCategoriesControllerTest extends IntegrationTestCase
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
        //'app.FeederGuides',
        'plugin.feeder.FeederCategories',
        'plugin.feeder.FeederCategoriesCoreCountries',
        'plugin.Feeder.FeederCategoriesVideoElements',
        'plugin.feeder.FeederFizzyBubbles',
        'plugin.feeder.FeederGlobalPriceLimit',
        'plugin.Feeder.FeederInfluencerMiniCategories',
        'plugin.Feeder.FeederInfluencers',
        'plugin.Feeder.FeederGuides',
        'app.Core/TranslationCoreCountries'
    ];
    const CURRENT_URL = '/feeder/feeder-influencer-mini-categories';
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

    public function testView()
    {
        //dd(1);
        $this->get(self::CURRENT_URL . '/view/1');
        $this->assertResponseOk();
    }

    public function testIndex()
    {
        //dd(1);
        $this->get(self::CURRENT_URL);
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
            'id'                   => 1,
            'name'                 => 'Lorem ipsum dolor sit amet',
            'url'                  => 'Lorem ipsum dolor sit amet',
            'image'                => 'Lorem ipsum dolor sit amet',
            'feeder_influencer_id' => 1,
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $FeederInfluencerMiniCategories = TableRegistry::getTableLocator()->get('FeederInfluencerMiniCategories');
        $query                          = $FeederInfluencerMiniCategories->find()->where(['id' => $data['id']]);
        $this->assertEquals(1, $query->count());
    }

    public function testEdit()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id'                   => 1,
            'name'                 => 'Lorem ipsum dolor sit amet',
            'url'                  => 'Lorem ipsum dolor sit amet',
            'image'                => 'Lorem ipsum dolor sit amet',
            'feeder_influencer_id' => 1,
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $FeederInfluencerMiniCategories = TableRegistry::getTableLocator()->get('FeederInfluencerMiniCategories');
        $feeder_cat                     = $FeederInfluencerMiniCategories->find()->where(['id' => $data['id']])->first();
        $this->assertEquals($data['id'], $feeder_cat->id);
    }

    public function testEditGoogle()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id'                   => 1,
            'name'                 => 'Lorem ipsum dolor sit amet',
            'url'                  => 'Lorem ipsum dolor sit amet',
            'image'                => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'feeder_influencer_id' => 1,
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $FeederInfluencerMiniCategories = TableRegistry::getTableLocator()->get('FeederInfluencerMiniCategories');
        $feeder_cat                     = $FeederInfluencerMiniCategories->find()->where(['id' => $data['id']])->first();
        $this->assertEquals($data['id'], $feeder_cat->id);
    }

    public function testAddGoogle()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id'                   => 1,
            'name'                 => 'Lorem ipsum dolor sit amet',
            'url'                  => 'Lorem ipsum dolor sit amet',
            'image'                => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'feeder_influencer_id' => 1,
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $FeederInfluencerMiniCategories = TableRegistry::getTableLocator()->get('FeederInfluencerMiniCategories');
        $query                          = $FeederInfluencerMiniCategories->find()->where(['id' => $data['id']]);
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

    public function testEditFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'id'                   => 1,
            'name'                 => 'Lorem ipsum dolor sit amet',
            'url'                  => 'Lorem ipsum dolor sit amet',
            'image'                => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'feeder_influencer_id' => 1,
        ];
        $this->post(self::CURRENT_URL . '/edit/13', $data);
        $this->assertResponseSuccess();
    }

    public function testEditView()
    {
        $this->get(self::CURRENT_URL . '/edit/1');
        $this->assertResponseOk();
    }

    public function testDelete()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post(self::CURRENT_URL . '/delete/1');
        $this->assertResponseSuccess();
    }
}
