<?php

namespace Feeder\Test\TestCase\Controller;

use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;
use Feeder\Controller\FeederWorldsController;
use \Psr\Http\Message\UploadedFileInterface;

/**
 * Feeder\Controller\FeederWorldsController Test Case
 */
class FeederWorldsControllerTest extends IntegrationTestCase
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
        'plugin.feeder.FeederWorlds',
        'plugin.feeder.FeederCategoriesCoreCountries',
        'app.Core/TranslationCoreCountries'
    ];
    const CURRENT_URL = '/feeder/feeder-worlds';
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
            'name'     => 'Lorem ipsum dolor sit amet',
            'image'    => 'Lorem ipsum dolor sit amet',
            'link'     => 'Lorem ipsum dolor sit amet',
            'modified' => '2018-10-02 11:36:09',
            'created'  => '2018-10-02 11:36:09'
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
    }

    public function testAddFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'id'       => 'adb',
            'name'     => 'Lorem ipsum dolor sit amet',
            'image'    => 'Lorem ipsum dolor sit amet',
            'link'     => 'Lorem ipsum dolor sit amet',
            'modified' => '2018-10-02 11:36:09',
            'created'  => '2018-10-02 11:36:09'
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
    }

    public function testEdit()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'name'     => 'Lorem ipsum dolor sit amet',
            'image'    => 'Lorem ipsum dolor sit amet',
            'link'     => 'Lorem ipsum dolor sit amet',
            'modified' => '2018-10-02 11:36:09',
            'created'  => '2018-10-02 11:36:09'
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
    }

    public function testEditFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'id'       => 'abd',
            'name'     => 'Lorem ipsum dolor sit amet',
            'image'    => 'Lorem ipsum dolor sit amet',
            'link'     => 'Lorem ipsum dolor sit amet',
            'modified' => '2018-10-02 11:36:09',
            'created'  => '2018-10-02 11:36:09'
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
    }

    public function testAddGoogle()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'name'     => 'Lorem ipsum dolor sit amet',
            'link'     => 'Lorem ipsum dolor sit amet',
            'modified' => '2018-10-02 11:36:09',
            'image'    => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'created'  => '2018-10-02 11:36:09'
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
    }

    public function testEditGoogle()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'name'     => 'Lorem ipsum dolor sit amet',
            'image'    => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'link'     => 'Lorem ipsum dolor sit amet',
            'modified' => '2018-10-02 11:36:09',
            'created'  => '2018-10-02 11:36:09'
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

    public function testUpdateMetaTags()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'meta_title' => 'Lorem ipsum dolor sit amet'
        ];
        $this->post(self::CURRENT_URL . '/updateMetaTags', $data);
        $this->assertResponseSuccess();
    }

    public function testUpdateWorldsInfo()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'image' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg'
        ];
        $this->post(self::CURRENT_URL . '/updateWorldsInfo', $data);
        $this->assertResponseSuccess();
    }

    public function testUpdateWorldsInfoGoogle()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'image' => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg'
        ];
        $this->post(self::CURRENT_URL . '/updateWorldsInfo', $data);
        $this->assertResponseSuccess();
    }
}
