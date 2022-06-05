<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CoreUsersController;
use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Core\Configure;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\Cache\Cache;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\MaintenancesController Test Case
 */
class MaintenancesControllerTest extends IntegrationTestCase
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
        'app.Acos/AcosAros'
    ];

    const CURRENT_URL = '/maintenances';
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
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $resp = $this->get(self::CURRENT_URL. '/view');
        $this->assertResponseSuccess();
    }
    
    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $resp = $this->get(self::CURRENT_URL. '/add');
        $this->assertResponseSuccess();
    }
    
    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $resp = $this->get(self::CURRENT_URL. '/edit');
        $this->assertResponseSuccess();
    }
    
    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $resp = $this->get(self::CURRENT_URL. '/delete');
        $this->assertResponseSuccess();
    }
    
    /**
     * Test index pass method
     *
     * @return void
     */
    public function testIndexPass()
    {
        Configure::write('maintenance.status', '1');
        $resp = $this->get(self::CURRENT_URL);
        $this->assertResponseSuccess();
    }

}
