<?php
namespace Feeder\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Feeder\Model\Table\FeederQuizzesTable;

/**
 * Feeder\Model\Table\FeederQuizzesTable Test Case
 */
class FeederQuizzesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Feeder\Model\Table\FeederQuizzesTable
     */
    public $FeederQuizzes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.Feeder.FeederQuizzes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('FeederQuizzes') ? [] : ['className' => FeederQuizzesTable::class];
        $this->FeederQuizzes = TableRegistry::getTableLocator()->get('FeederQuizzes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeederQuizzes);

        parent::tearDown();
    }

    public function testFindAll()
    {
        $FeederQuizzes = $this->FeederQuizzes->find();
        $this->assertInstanceOf("Cake\Orm\Query", $FeederQuizzes);
        $result = $FeederQuizzes->enableHydration(false)->toArray();
        $expected = [1];
        $idComparison = [
            $result[0]['id'],
        ];
        $this->assertEquals($expected, $idComparison);
    }

    public function testAdd()
    {
        $FeederQuizzes = $this->FeederQuizzes->newEntity([
            'id' => 2,
            'name' => 'Lorem ipsum dolor sit amet',
            'url_path' => 'Lorem ipsum dolor sit amet',
            'active' => 1,
            'meta_description' => 'Lorem ipsum dolor sit amet',
            'title_tag' => 'Lorem ipsum dolor sit amet',
            'description' => 'Lorem ipsum dolor sit amet',
            'question_config' => json_encode([
                [
                    'answers' => [
                        [
                            'result' => 1
                        ]
                    ]
                ]
            ])
        ]);
        $result = $this->FeederQuizzes->save($FeederQuizzes);
        $this->assertInstanceOf('Feeder\Model\Entity\FeederQuiz', $result);

    }
}
