<?php

namespace App\Test\TestCase\Controller;

use App\Controller\CoreCountriesController;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;

/**
 * App\Controller\CoreCountriesController Test Case
 */
class CoreCountriesControllerTest extends IntegrationTestCase
{
    use IntegrationTestTrait;
    use GenerateCoreUserEntity;

    const CURRENT_URL = '/core_countries';
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Core/CoreCountries',
        'app.Core/CoreUsers',
        'app.Core/CoreSellers',
        'app.Core/CoreSellerTypes',
        'app.Core/CoreUserRoles',
        'app.Core/CoreLanguages',
        'app.Core/CoreUserRolesCoreUsers',
        'app.Core/TranslationCoreCountries',
        'app.Acos/Aros',
        'app.Acos/Acos',
        'app.Acos/AcosAros',
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
        $this->get(self::CURRENT_URL.'/view/1');
        $this->assertResponseOk();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdds()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'iso_code'        => "ES",
            'iso_code_3166_2' => "ES",
            'name'            => "Spain",
            'default_tax'     => 19.00,
            'created'         => new FrozenTime(\time()),
            'modified'        => new FrozenTime(\time())
        ];

        $this->post(self::CURRENT_URL.'/add', $data);
        $this->assertResponseSuccess();
        $countries = TableRegistry::getTableLocator()->get('core_countries');
        $country   = $countries->find()->where(['core_countries.iso_code' => "ES"])->first();
        $this->assertEquals($data['iso_code'], $country['iso_code']);

    }

    public function testAddView()
    {
        $this->get(self::CURRENT_URL.'/add');
        $this->assertResponseSuccess();
    }

    public function testAddFailed()
    {

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'id'          => 1,
            'iso_code'    => 'sssss',
            'name'        => 'Country Name',
            'default_tax' => 1,
            'created'     => '2016-01-22 13:19:21',
            'modified'    => '2016-01-22 13:19:21'
        ];

        $this->post(self::CURRENT_URL.'/add', $data);
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
            'id'          => 1,
            'iso_code'    => 'DE',
            'name'        => 'Deutsch',
            'default_tax' => 13,
            'created'     => '2016-01-22 13:19:21',
            'modified'    => '2016-01-22 13:19:21'
        ];

        $this->post(self::CURRENT_URL.'/edit/1', $data);
        $this->assertResponseSuccess();
        $countries = TableRegistry::getTableLocator()->get('core_countries');
        $country   = $countries->find()->where(['iso_code' => $data['iso_code']])->first();
        $this->assertEquals($data['iso_code'], $country->iso_code);
    }

    public function testEditView()
    {

        $this->get(self::CURRENT_URL.'/edit/1');
        $this->assertResponseSuccess();
    }

    public function testEditFailed()
    {

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'iso_code'    => null,
            'name'        => null,
            'default_tax' => 13,
            'created'     => '2016-01-22 13:19:21',
            'modified'    => '2016-01-22 13:19:21'
        ];


        $this->post(self::CURRENT_URL.'/edit/1', $data);
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

        $this->post(self::CURRENT_URL.'/delete/1');
        $this->assertResponseSuccess();
        $countries = TableRegistry::getTableLocator()->get('core_countries');
        $country   = $countries->find()->where(['iso_code' => 'DE'])->count();
        $this->assertEquals(0, $country);
    }

    public function testDeleteFailed()
    {

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $cancelReason  = TableRegistry::getTableLocator()->get('core_countries')->get(1);
        $cancelReasons = $this->getMockForModel('CoreCountries', ['get', 'delete']);
        $cancelReasons->expects($this->once())->method('get')->will($this->returnValue($cancelReason));
        $cancelReasons->expects($this->once())->method('delete')->will($this->returnValue(false));

        $this->post(self::CURRENT_URL.'/delete/0');
        $this->assertResponseSuccess();
    }
}
