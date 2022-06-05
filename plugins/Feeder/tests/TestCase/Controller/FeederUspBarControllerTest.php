<?php
namespace Feeder\Test\TestCase\Controller;

use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;
use Feeder\Controller\FeederUspBarController;

/**
 * Feeder\Controller\FeederUspBarController Test Case
 */
class FeederUspBarControllerTest extends IntegrationTestCase
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
        'app.Core/CoreConfigurations',
        'app.Acos/Aros',
        'app.Acos/Acos',
        'app.Acos/AcosAros',
        'app.Core/CoreCountries',
        'plugin.feeder.FeederCategories',
        'plugin.feeder.FeederUspBar',
        'plugin.feeder.FeederCategoriesCoreCountries',
        'app.Core/TranslationCoreCountries'

    ];

    const CURRENT_URL = '/feeder/feeder-usp-bar';
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
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'usp_text' => 'Lorem ipsum dolor sit amet',
            'sort_order' => 1,
            'modified' => '2019-08-14 16:31:53',
            'image' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'created' => '2019-08-14 16:31:53'
            ];

        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $rows = TableRegistry::getTableLocator()->get('feeder_usp_bar');
        $rows = $rows->find()->where(['usp_text' => $data['usp_text']])->first();
        $this->assertEquals($data['usp_text'], $rows->usp_text);
    }

    public function testAddFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'usp_text' => 'Lorem ipsum dolor sit amet',
            'sort_order' => 'abcd',
            'modified' => '2019-08-14 16:31:53',
            'created' => '2019-08-14 16:31:53'
        ];

        $this->post(self::CURRENT_URL . '/add', $data);
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
            'usp_text' => 'Lorem ipsum dolor sit amet',
            'sort_order' => 1,
            'image' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'modified' => '2019-08-14 16:31:53',
            'created' => '2019-08-14 16:31:53'
        ];

        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $rows = TableRegistry::getTableLocator()->get('feeder_usp_bar');
        $rows = $rows->find()->where(['usp_text' => $data['usp_text']])->first();
        $this->assertEquals($data['usp_text'], $rows->usp_text);
    }

    public function testEditFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'usp_text' => 'Lorem ipsum dolor sit amet',
            'sort_order' => 'abcd',
            'modified' => '2019-08-14 16:31:53',
            'created' => '2019-08-14 16:31:53'
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
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

        $this->post(self::CURRENT_URL . '/delete/1');
        $this->assertResponseSuccess();
        $rows = TableRegistry::getTableLocator()->get('feeder_usp_bar');
        $resultCount = $rows->find()->where(['id' => 1])->count();
        $this->assertEquals(0, $resultCount);
    }


    public function testAddColors(){
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post(self::CURRENT_URL . '/addColors');
        $this->assertResponseSuccess();
    }

    public function testAddColorsGet(){
        $this->get(self::CURRENT_URL . '/addColors');
        $this->assertResponseSuccess();
    }

    public function testActivateUsp(){
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'usp_is_active' => 1
        ];

        $this->post(self::CURRENT_URL . '/activateUsp' , $data);
        $this->assertResponseSuccess();
    }
    public function testActivateUspView(){

        $this->get(self::CURRENT_URL . '/activateUsp'   );
        $this->assertResponseSuccess();
    }
}
