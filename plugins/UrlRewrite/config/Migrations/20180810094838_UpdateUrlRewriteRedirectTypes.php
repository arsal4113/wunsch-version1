<?php

use Migrations\AbstractMigration;
use Cake\ORM\TableRegistry;

/**
 * Class UpdateUrlRewriteRedirectTypes
 */
class UpdateUrlRewriteRedirectTypes extends AbstractMigration
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
        if(!$table->hasColumn('header')) {
            $table
                ->addColumn('header', 'string', ['limit' => 100, 'after' => 'name'])
                ->update();

            $typeTable = TableRegistry::getTableLocator()->get('UrlRewrite.UrlRewriteRedirectTypes');
            $types = $typeTable->find();

            foreach ($types as $type) {
                $type->header = __('HTTP/1.1 {0} {1}', [$type->code, $type->name]);
                $typeTable->save($type);
            }
        }
    }
}
