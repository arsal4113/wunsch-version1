<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UrlRewriteRedirectsFixture
 */
class UrlRewriteRedirectsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'url_rewrite_redirect_type_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'source_url' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'target_url' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'creator' => ['type' => 'string', 'length' => 200, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'timestamp' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'url_rewrite_redirect_type_id' => ['type' => 'index', 'columns' => ['url_rewrite_redirect_type_id'], 'length' => []],
            'source_url' => ['type' => 'index', 'columns' => ['source_url'], 'length' => []],
            'target_url' => ['type' => 'index', 'columns' => ['target_url'], 'length' => []],
            'creator' => ['type' => 'index', 'columns' => ['creator'], 'length' => []],
            'timestamp' => ['type' => 'index', 'columns' => ['timestamp'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'url_rewrite_redirects_ibfk_1' => ['type' => 'foreign', 'columns' => ['url_rewrite_redirect_type_id'], 'references' => ['url_rewrite_redirect_types', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'url_rewrite_redirect_type_id' => 1,
                'source_url' => 'Lorem ipsum dolor sit amet',
                'target_url' => 'Lorem ipsum dolor sit amet',
                'creator' => 'Lorem ipsum dolor sit amet',
                'timestamp' => 1,
                'created' => '2020-12-10 18:48:28',
                'modified' => '2020-12-10 18:48:28',
            ],
        ];
        parent::init();
    }
}
