<?php

namespace Feeder\Test\TestCase\Controller;

use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;
use Feeder\Controller\FeederHomepagesController;

/**
 * Feeder\Controller\FeederHomepagesController Test Case
 */
class FeederHomepagesControllerTest extends IntegrationTestCase
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
        'plugin.Feeder.FeederHomepageMidpageContainers',
        'plugin.Feeder.FeederCategories',
        'plugin.Feeder.FeederHomepages',
        'app.Core/TranslationCoreCountries'
    ];
    const CURRENT_URL = '/feeder/feeder-homepages';
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

    public function testAdd()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'big_banner_image'          => 'Lorem ipsum dolor sit amet',
            'big_banner_link'           => 'Lorem ipsum dolor sit amet',
            'first_small_banner_image'  => 'Lorem ipsum dolor sit amet',
            'first_small_banner_link'   => 'Lorem ipsum dolor sit amet',
            'second_small_banner_image' => 'Lorem ipsum dolor sit amet',
            'second_small_banner_link'  => 'Lorem ipsum dolor sit amet',
            'third_small_banner_image'  => 'Lorem ipsum dolor sit amet',
            'third_small_banner_link'   => 'Lorem ipsum dolor sit amet',
            'image'                     => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'fourth_small_banner_image' => 'Lorem ipsum dolor sit amet',
            'fourth_small_banner_link'  => 'Lorem ipsum dolor sit amet',
            'surprise_item_ids'         => 'Lorem ipsum dolor sit amet',
            'feeder_category_id'        => 1
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $cancelReasons = TableRegistry::getTableLocator()->get('feeder_homepages');
        $cancelReason  = $cancelReasons->find()->where(['big_banner_image' => $data['big_banner_image']])->first();
        $this->assertEquals($data['big_banner_image'], $cancelReason->big_banner_image);
    }

    public function testEdit()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'big_banner_image'          => 'Lorem ipsum dolor sit amet',
            'big_banner_link'           => 'Lorem ipsum dolor sit amet',
            'first_small_banner_image'  => 'Lorem ipsum dolor sit amet',
            'first_small_banner_link'   => 'Lorem ipsum dolor sit amet',
            'image'                     => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'second_small_banner_image' => 'Lorem ipsum dolor sit amet',
            'second_small_banner_link'  => 'Lorem ipsum dolor sit amet',
            'third_small_banner_image'  => 'Lorem ipsum dolor sit amet',
            'third_small_banner_link'   => 'Lorem ipsum dolor sit amet',
            'fourth_small_banner_image' => 'Lorem ipsum dolor sit amet',
            'fourth_small_banner_link'  => 'Lorem ipsum dolor sit amet',
            'surprise_item_ids'         => 'Lorem ipsum dolor sit amet',
            'feeder_category_id'        => 1
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $cancelReasons = TableRegistry::getTableLocator()->get('feeder_homepages');
        $cancelReason  = $cancelReasons->find()->where(['big_banner_image' => $data['big_banner_image']])->first();
        $this->assertEquals($data['big_banner_image'], $cancelReason->big_banner_image);
    }

    public function testConfigure()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'feeder_homepage_midpage_container_id' => 1
        ];
        $this->post(self::CURRENT_URL . '/configure', $data);
        $this->assertResponseSuccess();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAddGoogle()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'big_banner_image'          => 'Lorem ipsum dolor sit amet',
            'big_banner_link'           => 'Lorem ipsum dolor sit amet',
            'first_small_banner_image'  => 'Lorem ipsum dolor sit amet',
            'first_small_banner_link'   => 'Lorem ipsum dolor sit amet',
            'second_small_banner_image' => 'Lorem ipsum dolor sit amet',
            'second_small_banner_link'  => 'Lorem ipsum dolor sit amet',
            'third_small_banner_image'  => 'Lorem ipsum dolor sit amet',
            'third_small_banner_link'   => 'Lorem ipsum dolor sit amet',
            'image'                     => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'fourth_small_banner_image' => 'Lorem ipsum dolor sit amet',
            'fourth_small_banner_link'  => 'Lorem ipsum dolor sit amet',
            'surprise_item_ids'         => 'Lorem ipsum dolor sit amet',
            'feeder_category_id'        => 1
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $cancelReasons = TableRegistry::getTableLocator()->get('feeder_homepages');
        $cancelReason  = $cancelReasons->find()->where(['big_banner_image' => $data['big_banner_image']])->first();
        $this->assertEquals($data['big_banner_image'], $cancelReason->big_banner_image);
    }

    public function testAddFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'big_banner_image'          => null,
            'big_banner_link'           => null,
            'first_small_banner_image'  => null,
            'first_small_banner_link'   => null,
            'second_small_banner_image' => null,
            'second_small_banner_link'  => null,
            'third_small_banner_image'  => null,
            'third_small_banner_link'   => null,
            'fourth_small_banner_image' => null,
            'fourth_small_banner_link'  => null,
            'surprise_item_ids'         => null,
            'feeder_category_id'        => 'asdasd'
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
    }

    public function testAddView()
    {
        $this->get(self::CURRENT_URL . '/add');
        $this->assertResponseSuccess();
    }

    /*   public function testAddException()
       {
           $this->expectException(InvalidArgumentException::class);
           $this->post(self::CURRENT_URL .'/add');
           $this->assertResponseSuccess();
       }*/
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
            'big_banner_image'          => 'Lorem ipsum dolor sit amet',
            'big_banner_link'           => 'Lorem ipsum dolor sit amet',
            'first_small_banner_image'  => 'Lorem ipsum dolor sit amet',
            'first_small_banner_link'   => 'Lorem ipsum dolor sit amet',
            'image'                     => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'second_small_banner_image' => 'Lorem ipsum dolor sit amet',
            'second_small_banner_link'  => 'Lorem ipsum dolor sit amet',
            'third_small_banner_image'  => 'Lorem ipsum dolor sit amet',
            'third_small_banner_link'   => 'Lorem ipsum dolor sit amet',
            'fourth_small_banner_image' => 'Lorem ipsum dolor sit amet',
            'fourth_small_banner_link'  => 'Lorem ipsum dolor sit amet',
            'surprise_item_ids'         => 'Lorem ipsum dolor sit amet',
            'feeder_category_id'        => 1
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $cancelReasons = TableRegistry::getTableLocator()->get('feeder_homepages');
        $cancelReason  = $cancelReasons->find()->where(['big_banner_image' => $data['big_banner_image']])->first();
        $this->assertEquals($data['big_banner_image'], $cancelReason->big_banner_image);
    }

    public function testEditFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'big_banner_image'          => null,
            'big_banner_link'           => null,
            'first_small_banner_image'  => null,
            'first_small_banner_link'   => null,
            'second_small_banner_image' => null,
            'second_small_banner_link'  => null,
            'third_small_banner_image'  => null,
            'third_small_banner_link'   => null,
            'fourth_small_banner_image' => null,
            'fourth_small_banner_link'  => null,
            'surprise_item_ids'         => null,
            'feeder_category_id'        => 'abcd'
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
    }

    public function testEditView()
    {
        $this->get(self::CURRENT_URL . '/edit/1');
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
        $cancelReasons = TableRegistry::getTableLocator()->get('feeder_homepages');
        $resultCount   = $cancelReasons->find()->where(['id' => 1])->count();
        $this->assertEquals(0, $resultCount);
    }

    public function testConfigureGoogle()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $data = [
            'feeder_homepage_midpage_container_id' => 1,
            'image'                                => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
        ];
        $this->post(self::CURRENT_URL . '/configure', $data);
        $this->assertResponseSuccess();
    }

    public function testConfigureView()
    {
        $this->get(self::CURRENT_URL . '/configure');
        $this->assertResponseSuccess();
    }
}
