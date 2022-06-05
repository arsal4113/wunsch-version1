<?php
namespace Feeder\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Feeder\Controller\FeederCategoriesVideoElementsController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Core\Configure;
use Cake\Cache\Cache;

/**
 * Feeder\Controller\FeederCategoriesVideoElementsController Test Case
 *
 * @uses \Feeder\Controller\FeederCategoriesVideoElementsController
 */
class FeederCategoriesVideoElementsControllerTest extends IntegrationTestCase
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
        'plugin.feeder.FeederCategoriesCoreCountries',
        'plugin.Feeder.FeederCategoriesVideoElements',
        'app.Core/TranslationCoreCountries'

    ];

    const CURRENT_URL = '/feeder/feeder-categories-video-elements';
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
        $this->get(self::CURRENT_URL.'/view/1');
        $this->assertResponseOk();
    }
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
    public function testAdd(){
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id' => 1,
            'is_active' => 1,
            'video_mp4' => 'Lorem ipsum dolor sit amet',
            'video_webm' => 'Lorem ipsum dolor sit amet',
            'background_color' => 'Lorem ipsum dolor sit amet',
            'headline' => 'Lorem ipsum dolor sit amet',
            'headline_color' => 'Lorem ipsum dolor sit amet'
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $FeederCategoriesVideoElement = TableRegistry::getTableLocator()->get('FeederCategoriesVideoElements');
        $query = $FeederCategoriesVideoElement->find()->where(['id' => $data['id']]);
        $this->assertEquals(1, $query->count());
    }

    public function testEdit(){
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id' => 1,
            'is_active' => 1,
            'video_mp4' => 'Lorem ipsum dolor sit amet',
            'video_webm' => 'Lorem ipsum dolor sit amet',
            'background_color' => 'Lorem ipsum dolor sit amet',
            'headline' => 'Lorem ipsum dolor sit amet',
            'headline_color' => 'Lorem ipsum dolor sit amet'

        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $feeder_cats = TableRegistry::getTableLocator()->get('FeederCategoriesVideoElements');
        $feeder_cat   = $feeder_cats->find()->where(['id' => $data['id']])->first();
        $this->assertEquals($data['id'], $feeder_cat->id);
    }

    public function testAddGoogle()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id' => 1,
            'is_active' => 1,
            'video_mp4' => 'Lorem ipsum dolor sit amet',
            'video_webm' => 'Lorem ipsum dolor sit amet',
            'background_color' => 'Lorem ipsum dolor sit amet',
            'headline' => 'Lorem ipsum dolor sit amet',
            'headline_color' => 'Lorem ipsum dolor sit amet'
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $feeder_cats = TableRegistry::getTableLocator()->get('FeederCategoriesVideoElements');
        $query = $feeder_cats->find()->where(['id' => $data['id']]);
        $this->assertEquals(1, $query->count());
    }

    public function testAddFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [];

        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
    }

    public function testEditImage(){
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id' => 1,
            'is_active' => 1,
            'video_mp4' => 'Lorem ipsum dolor sit amet',
            'video_webm' => 'Lorem ipsum dolor sit amet',
            'background_color' => 'Lorem ipsum dolor sit amet',
            'headline' => 'Lorem ipsum dolor sit amet',
            'headline_color' => 'Lorem ipsum dolor sit amet'

        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $feeder_cats = TableRegistry::getTableLocator()->get('FeederCategoriesVideoElements');
        $feeder_cat   = $feeder_cats->find()->where(['id' => $data['id']])->first();
        $this->assertEquals($data['id'], $feeder_cat->id);
    }

    public function testEditView(){

        $this->get(self::CURRENT_URL . '/edit/1');
        $this->assertResponseSuccess();
    }

    public function testEditFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'id' => null,
            'is_active' => null,
            'video_mp4' => 'Lorem ipsum dolor sit amet',
            'video_webm' => 'Lorem ipsum dolor sit amet',
            'background_color' => 'Lorem ipsum dolor sit amet',
            'headline' => 'Lorem ipsum dolor sit amet',
            'headline_color' => 'Lorem ipsum dolor sit amet'

        ];

        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
    }

    public function testEditFailedTest(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'id' => null,
            'is_active' => null,
            'video_mp4' => null,
            'video_webm' => null,
            'background_color' => null,
            'headline' => null,
            'headline_color' => null
        ];

        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
    }

    public function testDelete()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post(self::CURRENT_URL . '/delete/1');
        $this->assertResponseSuccess();
    }

    public function testDeleteFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->post(self::CURRENT_URL . '/delete/1');
        $this->assertResponseSuccess();
    }
}
