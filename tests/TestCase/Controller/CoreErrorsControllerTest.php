<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CoreErrorsController;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;

/**
 * App\Controller\CoreErrorsController Test Case
 */
class CoreErrorsControllerTest extends IntegrationTestCase
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
        'app.Core/CoreErrors',
        'app.Core/CoreSellers',
        'app.Core/CoreSellerTypes',
        'app.Core/CoreUserRoles',
        'app.Core/CoreLanguages',
        'app.Core/CoreUserRolesCoreUsers',
        'app.Acos/Aros',
        'app.Acos/Acos',
        'app.Acos/AcosAros',
    ];

    const CURRENT_URL = '/core_errors';
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
            'core_seller_id' => 1,
            'type' => 'Lorem ipsum dolor sit amet',
            'code' => 'Loremd ipsum dolor sit amet',
            'sub_code' => 'Lorem ipsum dolor sit amet',
            'message' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'foreign_key' => 'Lorem ipsum dolor sit amet',
            'foreign_model' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-02-03 15:03:13',
            'modified' => '2016-02-03 15:03:13'
        ];

        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseSuccess();
        $errors = TableRegistry::getTableLocator()->get('core_errors');
        $error = $errors->find()->where(['code' => $data['code']])->first();
        $this->assertEquals($data['code'], $error->code);
    }

    public function testAddView(){
        $this->get(self::CURRENT_URL . '/add');
        $this->assertResponseCode(500);
    }

    public function testAddFailed(){


        $this->enableCsrfToken();
        $this->enableSecurityToken();


        $data = [];
        $this->post(self::CURRENT_URL . '/add', $data);
        $this->assertResponseCode(500);
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
            'id' => 1,
            'core_seller_id' => 1,
            'type' => 'Lorem ipsum dolor sit amet',
            'code' => 'Loremd ipsum dolor sit amet',
            'sub_code' => 'Lorem ipsum dolor sit amet',
            'message' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'foreign_key' => 'Lorem ipsum dolor sit amet',
            'foreign_model' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-02-03 15:03:13',
            'modified' => '2016-02-03 15:03:13'
        ];

        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseSuccess();
        $errors = TableRegistry::getTableLocator()->get('core_errors');
        $error = $errors->find()->where(['code' => $data['code']])->first();
        $this->assertEquals($data['code'], $error->code);
    }

    public function testEditFailed()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'core_seller_id' => null,
            'type' => null,
            'code' => null,
            'sub_code' => 'Lorem ipsum dolor sit amet',
            'message' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'foreign_key' => 'Lorem ipsum dolor sit amet',
            'foreign_model' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-02-03 15:03:13',
            'modified' => '2016-02-03 15:03:13'
        ];

        $this->post(self::CURRENT_URL . '/edit/1', $data);
        $this->assertResponseCode(500);
    }

    public function testEditView(){
        $this->get(self::CURRENT_URL . '/edit/1');
        $this->assertResponseCode(500);
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
        $category = TableRegistry::getTableLocator()->get('core_errors');
        $resultCount = $category->find()->where(['id' => 1])->count();
        $this->assertEquals(0, $resultCount);
    }

    public function testDeleteFailed(){

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $cancelReason = TableRegistry::getTableLocator()->get('core_errors')->get(1);
        $cancelReasons = $this->getMockForModel('CoreErrors', ['get', 'delete']);
        $cancelReasons->expects($this->once())->method('get')->will($this->returnValue($cancelReason));
        $cancelReasons->expects($this->once())->method('delete')->will($this->returnValue(false));

        $this->post(self::CURRENT_URL . '/delete/0');
        $this->assertResponseSuccess();
    }

    public function testDownload(){
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $data = [
            'startTime' => [
                'year' => '2016',
                'month'=> '02',
                'day' => '03',
                'hour' => '15'
            ],
            'endTime' =>  [
                'year' => '2020',
                'month'=> '02',
                'day' => '03',
                'hour' => '15'
            ]
        ];

        $this->post(self::CURRENT_URL . '/download', $data);
        $this->assertResponseSuccess();
    }

    public function testDownloadView(){
        $this->get(self::CURRENT_URL . '/download');
        $this->assertResponseSuccess();
    }

}
