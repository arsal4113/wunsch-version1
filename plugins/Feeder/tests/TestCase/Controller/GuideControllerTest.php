<?php
namespace Feeder\Test\TestCase\Controller;

use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;
use Feeder\Controller\GuideController;
use \Psr\Http\Message\UploadedFileInterface;

/**
 * Feeder\Controller\WorldsController Test Case
 */
class GuideControllerTest extends IntegrationTestCase
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
        //'app.FeederGuides',
        'plugin.feeder.FeederCategories',
        'plugin.feeder.FeederCategoriesCoreCountries',
        'plugin.Feeder.FeederCategoriesVideoElements',
        'plugin.feeder.FeederFizzyBubbles',
        'plugin.feeder.FeederGlobalPriceLimit',
        'plugin.Feeder.FeederGuides',
        'plugin.Feeder.FeederPillarPages',
        'app.FeederGuidesFeederCategories',
        'app.FeederGuidesFeederPillarPages',
        'app.Core/TranslationCoreCountries',
        'plugin.Feeder.FeederHomepages',
        'plugin.Feeder.FeederHomepageBanners',
        'plugin.Feeder.FeederHomepageMidpageContainers'
    ];

    const CURRENT_URL = '/feeder';
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
        $this->get(self::CURRENT_URL . '/guides');
        $this->assertResponseOk();
    }

    public function testIndexId(){
        $this->get(self::CURRENT_URL . '/guide/index/1');
        $this->assertResponseOk();
    }



}
