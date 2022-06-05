<?php
namespace Feeder\Test\TestCase\Controller;

use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Feeder\Controller\FeederQuizResultsController;

/**
 * Feeder\Controller\FeederQuizResultsController Test Case
 *
 * @uses \Feeder\Controller\FeederQuizResultsController
 */
class FeederQuizResultsControllerTest extends TestCase
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
        'plugin.feeder.FeederQuizResults',
        'plugin.feeder.FeederCategories',
        'plugin.feeder.FeederCategoriesCoreCountries',
        'app.Core/TranslationCoreCountries'

    ];

    const CURRENT_URL = '/feeder/feeder-quiz-results';
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
        $this->get(self::CURRENT_URL. '/view/1');
        $this->assertResponseOk();
    }

    public function testAdd()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'name' => 'Lorem ipsum dolor sit amet',
            'quiz_description' => 'Lorem ipsum dolor sit amet',
            'headline' => 'Lorem ipsum dolor sit amet',
            'explanation' => 'Lorem ipsum dolor sit amet',
            'image' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'button_text' => 'Lorem ipsum dolor sit amet',
            'button_link' => 'Lorem ipsum dolor sit amet',
            'image_src' => 'Lorem ipsum dolor sit amet'
        ];

        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $rows = TableRegistry::getTableLocator()->get('feeder_quiz_results');
        $rows = $rows->find()->where(['name' => $data['name']])->first();
        $this->assertEquals($data['name'], $rows->name);

    }
    public function testEdit()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'name' => 'Lorem ipsum dolor sit amet',
            'quiz_description' => 'Lorem ipsum dolor sit amet',
            'image' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'headline' => 'Lorem ipsum dolor sit amet',
            'explanation' => 'Lorem ipsum dolor sit amet',
            'button_text' => 'Lorem ipsum dolor sit amet',
            'button_link' => 'Lorem ipsum dolor sit amet',
            'image_src' => 'Lorem ipsum dolor sit amet'
        ];

        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $rows = TableRegistry::getTableLocator()->get('feeder_quiz_results');
        $rows = $rows->find()->where(['name' => $data['name']])->first();
        $this->assertEquals($data['name'], $rows->name);
    }


    /**
     * Test add method
     *
     * @return void
     */
    public function testAddImage()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'name' => 'Lorem ipsum dolor sit amet',
            'quiz_description' => 'Lorem ipsum dolor sit amet',
            'headline' => 'Lorem ipsum dolor sit amet',
            'explanation' => 'Lorem ipsum dolor sit amet',
            'image' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'button_text' => 'Lorem ipsum dolor sit amet',
            'button_link' => 'Lorem ipsum dolor sit amet',
            'image_src' => 'Lorem ipsum dolor sit amet'
        ];

        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $rows = TableRegistry::getTableLocator()->get('feeder_quiz_results');
        $rows = $rows->find()->where(['name' => $data['name']])->first();
        $this->assertEquals($data['name'], $rows->name);

    }

    public function testAddFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'name' => null,
            'quiz_description' => null,
            'headline' => null,
            'explanation' => null,
            'button_text' => null,
            'button_link' => null,
            'image_src' => 'Lorem ipsum dolor sit amet'
        ];

        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
    }



    /**
     * Test edit method
     *
     * @return void
     */
    public function testEditImage()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'name' => 'Lorem ipsum dolor sit amet',
            'quiz_description' => 'Lorem ipsum dolor sit amet',
            'image' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'headline' => 'Lorem ipsum dolor sit amet',
            'explanation' => 'Lorem ipsum dolor sit amet',
            'button_text' => 'Lorem ipsum dolor sit amet',
            'button_link' => 'Lorem ipsum dolor sit amet',
            'image_src' => 'Lorem ipsum dolor sit amet'
        ];

        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $rows = TableRegistry::getTableLocator()->get('feeder_quiz_results');
        $rows = $rows->find()->where(['name' => $data['name']])->first();
        $this->assertEquals($data['name'], $rows->name);
    }

    public function testEditFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'id' => 'Lorem ipsum dolor sit amet',
            'quiz_description' => 'Lorem ipsum dolor sit amet',
            'headline' => 'Lorem ipsum dolor sit amet',
            'explanation' => 'Lorem ipsum dolor sit amet',
            'button_text' => 'Lorem ipsum dolor sit amet',
            'button_link' => 'Lorem ipsum dolor sit amet',
            'image_src' => 'Lorem ipsum dolor sit amet'
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
        $rows = TableRegistry::getTableLocator()->get('feeder_quiz_results');
        $resultCount = $rows->find()->where(['id' => 1])->count();
        $this->assertEquals(0, $resultCount);
    }

    public function testDeleteFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $cancelReason = TableRegistry::getTableLocator()->get('feeder_quiz_results')->get(1);
        $rows = $this->getMockForModel('feeder_quiz_results', ['get', 'delete']);
        $rows->expects($this->once())->method('get')->will($this->returnValue($cancelReason));
        $rows->expects($this->once())->method('delete')->will($this->returnValue(false));

        $this->post(self::CURRENT_URL . '/delete/0');
        $this->assertResponseSuccess();
    }
}
