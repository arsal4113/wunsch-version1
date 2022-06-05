<?php

namespace App\Test\TestCase\Controller;

use App\Controller\CoreLanguagesController;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;

/**
 * App\Controller\CoreLanguagesController Test Case
 */
class CoreLanguagesControllerTest extends IntegrationTestCase
{
    use IntegrationTestTrait;
    use GenerateCoreUserEntity;

    const CURRENT_URL = '/core_languages';
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
        'app.Core/EbayAutoListerConfigurations',
        'app.Core/EbayLaunchProfiles',
        'app.Core/EbayListings',
        'app.Core/EbayDisputeExplanationNames',
        'app.Core/EbayDisputeReasonNames',
    ];
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
            'iso_code' => 'de',
            'name'     => "Deutschs",
            'created'  => new FrozenTime(\time()),
            'modified' => new FrozenTime(\time()),
        ];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $languages = TableRegistry::getTableLocator()->get('core_languages');
        $language   = $languages->find()->where(['name' => $data['name']])->first();
        $this->assertEquals($data['name'], $language->name);
    }

    public function testAddView(){
        $this->get(self::CURRENT_URL . '/add');
        $this->assertResponseSuccess();
    }

    public function testAddFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [];

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
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'iso_code' => 'DE',
            'name'     => "Deutsch",
            'created'  => new FrozenTime(\time()),
            'modified' => new FrozenTime(\time()),
        ];

        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $languages = TableRegistry::getTableLocator()->get('core_languages');
        $language   = $languages->find()->where(['name' => $data['name']])->first();
        $this->assertEquals($data['name'], $language->name);
    }

    public function testEditView(){

        $this->get(self::CURRENT_URL . '/edit/1');
        $this->assertResponseSuccess();
    }

    public function testEditFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'iso_code' => null,
            'name'     => null,
            'created'  => new FrozenTime(\time()),
            'modified' => new FrozenTime(\time()),
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
        $resp = $this->post(self::CURRENT_URL . '/delete/2');
        $this->assertResponseSuccess();
        $language = TableRegistry::getTableLocator()->get('core_languages');
        $resultCount = $language->find()->where(['id' => 2])->count();
        $this->assertEquals(0, $resultCount);
    }

    public function testDeleteFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $cancelReason = TableRegistry::getTableLocator()->get('core_languages')->get(1);
        $cancelReasons = $this->getMockForModel('CoreLanguages', ['get', 'delete']);
        $cancelReasons->expects($this->once())->method('get')->will($this->returnValue($cancelReason));
        $cancelReasons->expects($this->once())->method('delete')->will($this->returnValue(false));

        $this->post(self::CURRENT_URL . '/delete/0');
        $this->assertResponseSuccess();
    }
}
