<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\CsvHandlerComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\CsvHandlerComponent Test Case
 */
class CsvHandlerComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\CsvHandlerComponent
     */
    public $CsvHandler;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->CsvHandler = new CsvHandlerComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CsvHandler);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testCsv()
    {
        $filePath = 'tmp/csvhandler.csv';
        $handle = $this->CsvHandler->openHandle($filePath, 'w');

        $csvLine = 'col1;col2;col3';
        $colCount = 3;
        $delimiter = ';';

        $this->CsvHandler->writeCsvLine($csvLine, $handle, $colCount, $delimiter);

        $this->CsvHandler->closeHandle($handle);
        $this->CsvHandler->getEntities($filePath);
        $entity = $this->CsvHandler->getStructure($filePath);
        $this->assertEquals([], $entity);

    }
}
