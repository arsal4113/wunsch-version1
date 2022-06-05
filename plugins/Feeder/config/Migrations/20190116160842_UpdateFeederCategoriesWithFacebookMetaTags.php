<?php
use Migrations\AbstractMigration;

class UpdateFeederCategoriesWithFacebookMetaTags extends AbstractMigration
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
        $tablePresent = $this->hasTable('feeder_categories');
        if($tablePresent) {
            $this->table('feeder_categories')
            ->addColumn('facebook_og_image', 'string', ['limit' => 200, 'default' => null, 'null' => true,  'after' => 'meta_description'])
            ->addColumn('facebook_og_description', 'string', ['limit' => 200, 'default' => null, 'null' => true,  'after' => 'meta_description'])
            ->addColumn('facebook_og_title', 'string', ['limit' => 200, 'default' => null, 'null' => true,  'after' => 'meta_description'])
            ->addColumn('facebook_og_type', 'string', ['limit' => 200, 'default' => null, 'null' => true,  'after' => 'meta_description'])
            ->addColumn('facebook_og_url', 'string', ['limit' => 200, 'default' => null, 'null' => true,  'after' => 'meta_description'])
            ->update();
        }

    }
}
