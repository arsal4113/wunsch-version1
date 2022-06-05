<?php
namespace Feeder\Test\TestCase\Controller;

use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;
use Feeder\Controller\FeederHeroItemsController;

/**
 * Feeder\Controller\FeederHeroItemsController Test Case
 */
class FeederHeroItemsControllerTest extends IntegrationTestCase
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
        'plugin.Feeder.FeederHomepageBanners',
        'plugin.Feeder.FeederCategoriesFeederHeroItems',
        'plugin.Feeder.FeederHeroItems',
        'plugin.Feeder.CustomerGenders',
        'plugin.Feeder.FeederHomepages',
        'plugin.Feeder.FeederCategories',
        'app.Core/TranslationCoreCountries'

    ];

    const CURRENT_URL = '/feeder/feeder-hero-items';
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
        $this->get(self::CURRENT_URL);
        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     **/

    public function testView()
    {
        $this->get(self::CURRENT_URL .'/view/14' );
        $this->assertResponseOk();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'id' => 1,
            'feeder_homepage_id' => 1,
            'type' => 1,
            'banner_image' => 'Lorem ipsum dolor sit amet',
            'banner_link' => 'Lorem ipsum dolor sit amet',
            'banner_bp_lg' => 'Lorem ipsum dolor sit amet',
            'banner_bp_md' => 'Lorem ipsum dolor sit amet',
            'banner_bp_sm' => 'Lorem ipsum dolor sit amet',
            'image' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'banner_bp_xs' => 'Lorem ipsum dolor sit amet',
            'sort_order' => 1,
            'modified' => '2018-11-28 15:20:43',
            'created' => '2018-11-28 15:20:43'
        ];

        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $rows = TableRegistry::getTableLocator()->get('feeder_homepage_banners');
        $cancelReason = $rows->find()->where(['banner_image' => $data['banner_image']])->first();
        $this->assertEquals($data['banner_image'], $cancelReason->banner_image);
    }


    public function testAddFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'id' => 1,
            'feeder_homepage_id' => null,
            'banner_image' => null,
            'banner_link' => null,
            'banner_bp_lg' => null,
            'banner_bp_md' => null,
            'banner_bp_sm' => null,
            'banner_bp_xs' => null,
            'sort_order' => null,
            'modified' => '2018-11-28 15:20:43',
            'created' => '2018-11-28 15:20:43'
        ];

        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
    }

    public function testAddView()
    {
        $this->get(self::CURRENT_URL . '/add');
        $this->assertResponseSuccess();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'id' => 1,
            'feeder_homepage_id' => 1,
            'type' => 1,
            'banner_image' => 'Lorem ipsum dolor sit amet',
            'banner_link' => 'Lorem ipsum dolor sit amet',
            'banner_bp_lg' => 'Lorem ipsum dolor sit amet',
            'banner_bp_md' => 'Lorem ipsum dolor sit amet',
            'image' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'banner_bp_sm' => 'Lorem ipsum dolor sit amet',
            'banner_bp_xs' => 'Lorem ipsum dolor sit amet',
            'sort_order' => 1,
            'modified' => '2018-11-28 15:20:43',
            'created' => '2018-11-28 15:20:43'
        ];

        $this->post(self::CURRENT_URL . '/edit/14', $data);
        $this->assertResponseSuccess();
        $rows = TableRegistry::getTableLocator()->get('feeder_homepage_banners');
        $cancelReason = $rows->find()->where(['banner_image' => $data['banner_image']])->first();
        $this->assertEquals($data['banner_image'], $cancelReason->banner_image);
    }

    public function testEditFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'id' => 1,
            'feeder_homepage_id' => 3,
            'banner_image' => null,
            'banner_link' => null,
            'banner_bp_lg' => null,
            'banner_bp_md' => null,
            'banner_bp_sm' => null,
            'banner_bp_xs' => null,
            'sort_order' => null,
            'modified' => '2018-11-28 15:20:43',
            'created' => '2018-11-28 15:20:43'
        ];

        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
    }

    public function testEditView()
    {
        $this->get(self::CURRENT_URL . '/edit/14');
        $this->assertResponseSuccess();
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post(self::CURRENT_URL . '/delete/14');
        $this->assertResponseSuccess();
        $rows = TableRegistry::getTableLocator()->get('feeder_homepage_banners');
        $resultCount = $rows->find()->where(['id' => 1])->count();
        $this->assertEquals(0, $resultCount);
    }

    public function testDeleteFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $cancelReason = TableRegistry::getTableLocator()->get('feeder_homepage_banners')->get(1);
        $rows = $this->getMockForModel('CoreCancelReasons', ['get', 'delete']);
        $rows->expects($this->once())->method('get')->will($this->returnValue($cancelReason));
        $rows->expects($this->once())->method('delete')->will($this->returnValue(false));

        $this->post(self::CURRENT_URL . '/delete/0');
        $this->assertResponseSuccess();
    }
}
