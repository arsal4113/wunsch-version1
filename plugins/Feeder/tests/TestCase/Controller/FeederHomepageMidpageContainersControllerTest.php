<?php
namespace Feeder\Test\TestCase\Controller;

use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;
use Feeder\Controller\FeederHomepageMidpageContainersController;

/**
 * Feeder\Controller\FeederHomepageMidpageContainersController Test Case
 */
class FeederHomepageMidpageContainersControllerTest extends IntegrationTestCase
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
        'plugin.Feeder.FeederHomepages',
        'app.Core/TranslationCoreCountries',
        'plugin.feeder.feeder_homepage_midpage_containers'
    ];

    const CURRENT_URL = '/feeder/feeder-homepage-midpage-containers';
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
     */
    public function testView()
    {
        $this->get(self::CURRENT_URL . '/view/1');
        $this->assertResponseOk();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'id' => 1,
            'homepage_id' => 1,
            'video_desktop' => 'Lorem ipsum dolor sit amet',
            'video_tablet' => 'Lorem ipsum dolor sit amet',
            'video_mobile' => 'Lorem ipsum dolor sit amet',
            'image_desktop' => 'Lorem ipsum dolor sit amet',
            'image_tablet' => 'Lorem ipsum dolor sit amet',
            'image_mobile' => 'Lorem ipsum dolor sit amet',
            'image' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'use_video' => 1,
            'click_url' => 'Lorem ipsum dolor sit amet',
            'button_text' => 'Lorem ipsum dolor sit amet',
            'button_color' => 'Lorem ipsum dolor sit amet',
            'background_color' => 'Lorem ipsum dolor sit amet'
        ];

        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
    }

    public function testEdit()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'id' => 1,
            'homepage_id' => 1,
            'video_desktop' => 'Lorem ipsum dolor sit amet',
            'video_tablet' => 'Lorem ipsum dolor sit amet',
            'video_mobile' => 'Lorem ipsum dolor sit amet',
            'image_desktop' => 'Lorem ipsum dolor sit amet',
            'image_tablet' => 'Lorem ipsum dolor sit amet',
            'image_mobile' => 'Lorem ipsum dolor sit amet',
            'image' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'use_video' => 1,
            'click_url' => 'Lorem ipsum dolor sit amet',
            'button_text' => 'Lorem ipsum dolor sit amet',
            'button_color' => 'Lorem ipsum dolor sit amet',
            'background_color' => 'Lorem ipsum dolor sit amet',
            'removed_media' => 'lipsum'
        ];

        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
    }

    public function testAddFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'id' => null,
            'homepage_id' => null,
            'video_desktop' => null,
            'video_tablet' => null,
            'video_mobile' => null,
            'image_desktop' => null,
            'image_tablet' => null,
            'image_mobile' => null,
            'use_video' => null,
            'click_url' => null,
            'button_text' => null,
            'button_color' => null,
            'background_color' => null
        ];

        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
    }

    public function testAddGoogle()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'id' => 1,
            'homepage_id' => 1,
            'video_desktop' => 'Lorem ipsum dolor sit amet',
            'video_tablet' => 'Lorem ipsum dolor sit amet',
            'video_mobile' => 'Lorem ipsum dolor sit amet',
            'image_desktop' => 'Lorem ipsum dolor sit amet',
            'image_tablet' => 'Lorem ipsum dolor sit amet',
            'image_mobile' => 'Lorem ipsum dolor sit amet',
            'image' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'use_video' => 1,
            'click_url' => 'Lorem ipsum dolor sit amet',
            'button_text' => 'Lorem ipsum dolor sit amet',
            'button_color' => 'Lorem ipsum dolor sit amet',
            'background_color' => 'Lorem ipsum dolor sit amet'
        ];

        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEditGoogle()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'id' => 1,
            'homepage_id' => 1,
            'video_desktop' => 'Lorem ipsum dolor sit amet',
            'video_tablet' => 'Lorem ipsum dolor sit amet',
            'video_mobile' => 'Lorem ipsum dolor sit amet',
            'image_desktop' => 'Lorem ipsum dolor sit amet',
            'image_tablet' => 'Lorem ipsum dolor sit amet',
            'image_mobile' => 'Lorem ipsum dolor sit amet',
            'image' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'use_video' => 1,
            'click_url' => 'Lorem ipsum dolor sit amet',
            'button_text' => 'Lorem ipsum dolor sit amet',
            'button_color' => 'Lorem ipsum dolor sit amet',
            'background_color' => 'Lorem ipsum dolor sit amet',
            'removed_media' => 'lipsum'
        ];

        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
    }

    public function testEditFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'homepage_id' => 'sdfadsf',
            'video_desktop' => null,
            'video_tablet' => null,
            'video_mobile' => null,
            'image_desktop' => null,
            'image_tablet' => null,
            'image_mobile' => null,
            'use_video' => 1,
            'click_url' => null,
            'button_text' => null,
            'button_color' => null,
            'background_color' => null,
            'removed_media' => null,
            'created' => null,
        ];

        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
    }

    public function testEditView(){
        $this->get(self::CURRENT_URL . '/edit/1');
        $this->assertResponseOk();
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

        $this->post(self::CURRENT_URL . '/delete/1');
        $this->assertResponseSuccess();
        $cancelReasons = TableRegistry::getTableLocator()->get('feeder_homepage_midpage_containers');
        $resultCount = $cancelReasons->find()->where(['id' => 1])->count();
        $this->assertEquals(0, $resultCount);
    }
}
