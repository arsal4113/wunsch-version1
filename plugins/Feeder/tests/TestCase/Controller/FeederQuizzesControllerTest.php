<?php

namespace Feeder\Test\TestCase\Controller;

use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Feeder\Controller\FeederQuizzesController;

/**
 * Feeder\Controller\FeederQuizzesController Test Case
 *
 * @uses \Feeder\Controller\FeederQuizzesController
 */
class FeederQuizzesControllerTest extends TestCase
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
        'plugin.feeder.FeederQuizzes',
        'plugin.feeder.FeederCategories',
        'plugin.feeder.FeederCategoriesCoreCountries',
        'app.Core/TranslationCoreCountries',
        'app.UrlRewriteRoutes',
        'plugin.UrlRewrite.UrlRewriteRedirectTypes',
        'plugin.UrlRewrite.UrlRewriteRedirects'
    ];
    const CURRENT_URL = '/feeder/feeder-quizzes';
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


    public function testUploadImageCatch()
    {
        $this->disableErrorHandlerMiddleware();
        $this->enableCsrfToken();
        $this->enableSecurityToken();
//        Configure::write('google_cloud.cloud_storage.is_active', true);
        $data = [
            'image' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
        ];
        $this->post(self::CURRENT_URL . '/uploadImage', $data);
//        $this->assertEquals(\Cake\Network\Exception\InternalErrorException::class, $this->_exception);
        $this->assertResponseSuccess();
    }

    public function testUploadImage()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $data = [
            'image' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
        ];
        $this->post(self::CURRENT_URL . '/uploadImage', $data);
        $this->assertResponseSuccess();
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
            'name'             => 'Lorem ipsum dolor sit amet',
            'url_path'         => 'Lorem ipsum dolor sit amet',
            'active'           => 1,
            'meta_description' => 'Lorem ipsum dolor sit amet',
            'image'            => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'title_tag'        => 'Lorem ipsum dolor sit amet',
            'description'      => 'Lorem ipsum dolor sit amet',
            'question_config'  => json_encode([
                [
                    'answers' => [
                        'result' => 1
                    ]
                ]
            ])
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $rows = TableRegistry::getTableLocator()->get('feeder_quizzes');
        $rows = $rows->find()->where(['name' => $data['name']])->first();
        $this->assertEquals($data['name'], $rows->name);
    }

    public function testAddFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'id'               => 'abcd',
            'name'             => null,
            'url_path'         => null,
            'active'           => null,
            'meta_description' => null,
            'title_tag'        => null,
            'description'      => null,
            'question_config'  => json_encode([
                [
                    'answers' => [
                        'result' => 1
                    ]
                ]
            ])
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
            'name'             => 'Lorem ipsum dolor sit amet',
            'url_path'         => 'Lorem ipsum dolor sit amet',
            'active'           => 1,
            'meta_description' => 'Lorem ipsum dolor sit amet',
            'image'            => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'title_tag'        => 'Lorem ipsum dolor sit amet',
            'description'      => 'Lorem ipsum dolor sit amet',
            'question_config'  => json_encode([
                [
                    'answers' => [
                        'result' => 1
                    ]
                ]
            ])
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $rows = TableRegistry::getTableLocator()->get('feeder_quizzes');
        $rows = $rows->find()->where(['name' => $data['name']])->first();
        $this->assertEquals($data['name'], $rows->name);
    }

    public function testEditFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'id'               => 'abcd',
            'name'             => null,
            'url_path'         => null,
            'active'           => null,
            'meta_description' => null,
            'title_tag'        => null,
            'description'      => null,
            'question_config'  => json_encode([
                [
                    'answers' => [
                        'result' => 1
                    ]
                ]
            ])
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
        $rows        = TableRegistry::getTableLocator()->get('feeder_quizzes');
        $resultCount = $rows->find()->where(['id' => 1])->count();
        $this->assertEquals(0, $resultCount);
    }
}
