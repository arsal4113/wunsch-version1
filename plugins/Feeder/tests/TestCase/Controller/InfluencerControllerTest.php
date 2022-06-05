<?php
namespace Feeder\Test\TestCase\Controller;

use App\Test\GlobalTraits\GenerateCoreUserEntity;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use Cake\TestSuite\IntegrationTestTrait;
use Feeder\Controller\InfluencerController;
use \Psr\Http\Message\UploadedFileInterface;

/**
 * Feeder\Controller\FeederWorldsController Test Case
 */
class InfluencerControllerTest extends IntegrationTestCase
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
        //'plugin.feeder.FeederHomepageMidpageContainers',
        'plugin.feeder.FeederHomepages',
        'plugin.feeder.FeederHompagesBreakpointBanners',
        'plugin.feeder.FeederHomepageBanners',
        'plugin.feeder.FeederFizzyBubbles',
        'plugin.feeder.FeederFizzyBubbleContainers',
        'plugin.feeder.FeederCategoriesVideoElements',
        'plugin.feeder.FeederGuides',
        'plugin.feeder.FeederWorlds',
        'plugin.feeder.FeederHomepageMidpageContainers',
        'plugin.feeder.FeederInfluencers',
        'plugin.feeder.FeederInfluencerMiniCategories',
        'plugin.ItoolCustomer.CustomerWishlists',
        'app.Core/TranslationCoreCountries'

    ];

    const CURRENT_URL = '/feeder/influencer';
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

    public function testIndexID()
    {
        $this->get(self::CURRENT_URL. '/index/1');
        $this->assertResponseOk();
    }

}
