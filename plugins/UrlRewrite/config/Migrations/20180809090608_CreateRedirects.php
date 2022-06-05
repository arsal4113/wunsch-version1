<?php

use Migrations\AbstractMigration;

/**
 * Class CreateRedirects
 */
class CreateRedirects extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {

        $table = $this->table('url_rewrite_redirect_types');
        if (!$table->exists()) {
            $table
                ->addColumn('code', 'integer', ['limit' => 3])
                ->addColumn('name', 'string', ['limit' => 250])
                ->addColumn('created', 'datetime', ['default' => null, 'null' => true])
                ->addColumn('modified', 'datetime', ['default' => null, 'null' => true])
                ->create();

            $data = [
                [
                    'code' => 301,
                    'name' => 'Moved Permanently',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'code' => 302,
                    'name' => 'Found (Moved Temporarily)',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'code' => 307,
                    'name' => 'Temporary Redirect',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ],
                [
                    'code' => 308,
                    'name' => 'Permanent Redirect',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s')
                ]
            ];

            $this->insert('url_rewrite_redirect_types', $data);
        }


        $table = $this->table('url_rewrite_redirects');
        if (!$table->exists()) {
            $table
                ->addColumn('url_rewrite_redirect_type_id', 'integer', ['limit' => 10])
                ->addColumn('source_url', 'string', ['limit' => 250])
                ->addColumn('target_url', 'string', ['limit' => 250])
                ->addColumn('creator', 'string', ['limit' => 200])
                ->addColumn('timestamp', 'integer', ['limit' => 10])
                ->addColumn('created', 'datetime', ['default' => null, 'null' => true])
                ->addColumn('modified', 'datetime', ['default' => null, 'null' => true])
                ->addIndex(['url_rewrite_redirect_type_id'])
                ->addIndex(['source_url'])
                ->addIndex(['target_url'])
                ->addIndex(['creator'])
                ->addIndex(['timestamp'])
                ->create();
        }

        $table = $this->table('url_rewrite_routes');
        if (!$table->exists()) {
            $table
                ->addColumn('target_url', 'string', ['limit' => 250])
                ->addColumn('plugin', 'string', ['limit' => 100, 'null' => true, 'default' => null])
                ->addColumn('controller', 'string', ['limit' => 100])
                ->addColumn('action', 'string', ['limit' => 100])
                ->addColumn('args', 'string', ['limit' => 250])
                ->addColumn('creator', 'string', ['limit' => 200])
                ->addColumn('timestamp', 'integer', ['limit' => 10])
                ->addColumn('created', 'datetime', ['default' => null, 'null' => true])
                ->addColumn('modified', 'datetime', ['default' => null, 'null' => true])
                ->addIndex(['creator'])
                ->addIndex(['timestamp'])
                ->create();
        }
    }
}
