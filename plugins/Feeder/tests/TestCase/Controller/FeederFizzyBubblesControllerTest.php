<?php

namespace Feeder\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\IntegrationTestCase;
use Feeder\Controller\FeederFizzyBubblesController;
use Cake\ORM\TableRegistry;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Core\Configure;
use Cake\Cache\Cache;

/**
 * Feeder\Controller\FeederFizzyBubblesController Test Case
 */
class FeederFizzyBubblesControllerTest extends IntegrationTestCase
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
        'plugin.feeder.FeederFizzyBubbles',
        'app.Core/TranslationCoreCountries'
    ];
    const CURRENT_URL = '/feeder/feeder-fizzy-bubbles';
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
            'id'              => 1,
            'url'             => 'Lorem ipsum dolor sit amet',
            'title_text'      => 'Lorem ipsum dolor sit amet',
            'title_color'     => 'Lorem ipsum dolor sit amet',
            'title_opacity'   => 1,
            'subline_text'    => 'Lorem ipsum dolor sit amet',
            'subline_color'   => 'Lorem ipsum dolor sit amet',
            'subline_opacity' => 1,
            'image_src'       => 'Lorem ipsum dolor sit amet',
            'sort_order'      => 'Lorem ipsum dolor ',
            'start_time'      => '2019-09-02 13:07:57',
            'end_time'        => '2019-09-02 13:07:57'
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $FeederFizzyBubbles = TableRegistry::getTableLocator()->get('FeederFizzyBubbles');
        $query              = $FeederFizzyBubbles->find()->where(['id' => $data['id']]);
        $this->assertEquals(1, $query->count());
    }

    public function testEdit()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id'              => 1,
            'url'             => 'Lorem ipsum dolor sit amet',
            'title_text'      => 'Lorem ipsum dolor sit amet',
            'title_color'     => 'Lorem ipsum dolor sit amet',
            'title_opacity'   => 1,
            'subline_text'    => 'Lorem ipsum dolor sit amet',
            'subline_color'   => 'Lorem ipsum dolor sit amet',
            'subline_opacity' => 1,
            'image_src'       => 'Lorem ipsum dolor sit amet',
            'sort_order'      => 'Lorem ipsum dolor ',
            'start_time'      => '2019-09-02 13:07:57',
            'end_time'        => '2019-09-02 13:07:57'
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $feeder_cats = TableRegistry::getTableLocator()->get('FeederFizzyBubbles');
        $feeder_cat  = $feeder_cats->find()->where(['id' => $data['id']])->first();
        $this->assertEquals($data['id'], $feeder_cat->id);
    }

    public function testAddGoogle()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id'              => 1,
            'url'             => 'Lorem ipsum dolor sit amet',
            'title_text'      => 'Lorem ipsum dolor sit amet',
            'title_color'     => 'Lorem ipsum dolor sit amet',
            'title_opacity'   => 1,
            'subline_text'    => 'Lorem ipsum dolor sit amet',
            'subline_color'   => 'Lorem ipsum dolor sit amet',
            'subline_opacity' => 1,
            'image_src'       => 'Lorem ipsum dolor sit amet',
            'image'           => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'sort_order'      => 'Lorem ipsum dolor ',
            'start_time'      => '2019-09-02 13:07:57',
            'end_time'        => '2019-09-02 13:07:57'
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $FeederFizzyBubbles = TableRegistry::getTableLocator()->get('FeederFizzyBubbles');
        $query              = $FeederFizzyBubbles->find()->where(['id' => $data['id']]);
        $this->assertEquals(1, $query->count());
    }

    public function testEditGoogle()
    {
        Configure::write('google_cloud.cloud_storage.is_active', true);
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'id'              => 1,
            'url'             => 'Lorem ipsum dolor sit amet',
            'title_text'      => 'Lorem ipsum dolor sit amet',
            'title_color'     => 'Lorem ipsum dolor sit amet',
            'title_opacity'   => 1,
            'subline_text'    => 'Lorem ipsum dolor sit amet',
            'subline_color'   => 'Lorem ipsum dolor sit amet',
            'subline_opacity' => 1,
            'image'           => 'https://storage.googleapis.com/wunsch-upload/feeder_categories/image/Beliebt.svg',
            'image_src'       => 'Lorem ipsum dolor sit amet',
            'sort_order'      => 'Lorem ipsum dolor ',
            'start_time'      => '2019-09-02 13:07:57',
            'end_time'        => '2019-09-02 13:07:57'
        ];
        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $feeder_cats = TableRegistry::getTableLocator()->get('FeederFizzyBubbles');
        $feeder_cat  = $feeder_cats->find()->where(['id' => $data['id']])->first();
        $this->assertEquals($data['id'], $feeder_cat->id);
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
            'id'              => null,
            'url'             => 'Lorem ipsum dolor sit amet',
            'title_text'      => 'Lorem ipsum dolor sit amet',
            'title_color'     => 'Lorem ipsum dolor sit amet',
            'title_opacity'   => 1,
            'subline_text'    => 'Lorem ipsum dolor sit amet',
            'subline_color'   => 'Lorem ipsum dolor sit amet',
            'subline_opacity' => 1,
            'image_src'       => 'Lorem ipsum dolor sit amet',
            'sort_order'      => 'Lorem ipsum dolor ',
            'start_time'      => '2019-09-02 13:07:57',
            'end_time'        => '2019-09-02 13:07:57'
        ];
        $this->post(self::CURRENT_URL . '/edit/13', $data);
        $this->assertResponseSuccess();
    }

    public function testEditView(){
        $this->get(self::CURRENT_URL. '/edit/1');
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
