<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoreOrderInvoicesFixture
 *
 */
class CoreOrderInvoicesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'core_order_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'core_order_invoice_range_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'invoice_number' => ['type' => 'string', 'length' => 200, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'invoice_date' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'core_order_id' => ['type' => 'index', 'columns' => ['core_order_id'], 'length' => []],
            'core_order_invoice_range_id' => ['type' => 'index', 'columns' => ['core_order_invoice_range_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'core_order_invoices_ibfk_1' => ['type' => 'foreign', 'columns' => ['core_order_id'], 'references' => ['core_orders', 'id'], 'update' => 'noAction', 'delete' => 'cascade', 'length' => []],
            'core_order_invoices_ibfk_2' => ['type' => 'foreign', 'columns' => ['core_order_invoice_range_id'], 'references' => ['core_order_invoice_ranges', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'core_order_id' => 1,
            'core_order_invoice_range_id' => 1,
            'invoice_number' => 'Lorem ipsum dolor sit amet',
            'invoice_date' => '2016-04-06 11:16:05',
            'created' => '2016-04-06 11:16:05',
            'modified' => '2016-04-06 11:16:05'
        ],
    ];
}
