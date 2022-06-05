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
 * App\Controller\PagesController Test Case
 */
class PagesControllerTest extends IntegrationTestCase
{
        use IntegrationTestTrait;
        use GenerateCoreUserEntity;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Core/CoreConfigurations',
        'app.Core/CoreLanguages',
        'app.UrlRewriteRoutes',
        'plugin.feeder.FeederCategories',
        'app.FeederGuides',
    ];

    const CURRENT_URL = '/pages';
    private $coreUser;

    public static function setUpBeforeClass()
    {
        Configure::write('Acl.database', 'test');
    }

    public function setup()
    {
        Cache::drop('api_user');
    }

    /**
     * Test display fail method
     *
     * @return void
     */
    public function testDisplay()
    {
        $this->get(self::CURRENT_URL.'/display/home');
        $this->assertResponseSuccess();
    }

    /**
     * Test display fail method
     *
     * @return void
     */
    public function testDisplayFail()
    {
        $this->get(self::CURRENT_URL.'/display/about-us');
        $this->assertResponseFailure();
    }

    /**
     * Test empty method
     *
     * @return void
     */
    public function testEmpty()
    {
        $this->get(self::CURRENT_URL.'/display');
        $this->assertResponseSuccess();
    }

    /**
     * Test subpage method
     *
     * @return void
     */
    public function testSubpage()
    {
        Configure::write('debug', false);
        $this->get(self::CURRENT_URL.'/display/about-us/1');
        $this->assertResponseError();
    }

}
