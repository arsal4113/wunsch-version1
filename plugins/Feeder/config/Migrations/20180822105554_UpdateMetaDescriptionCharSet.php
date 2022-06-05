<?php
use Migrations\AbstractMigration;

class UpdateMetaDescriptionCharSet extends AbstractMigration
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
        $table = $this->table('feeder_homepages');

        if(!$table->hasColumn('meta_description')) {
            $table
                ->addColumn('meta_description', 'string', ['limit' => 200, 'default' => null, 'null' => true,  'after' => 'mini_cart_feeder_category_id'])
                ->update();
        }

        if(!$table->hasColumn('title_tag')) {
            $table
                ->addColumn('title_tag', 'string', ['limit' => 200, 'default' => null, 'null' => true,  'after' => 'mini_cart_feeder_category_id'])
                ->update();
        }


        $table = $this->table('feeder_categories');
        if(!$table->hasColumn('meta_description')) {
            $table
                ->addColumn('meta_description', 'string', ['limit' => 200, 'default' => null, 'null' => true,  'after' => 'use_in_search'])
                ->update();
        }

        if(!$table->hasColumn('title_tag')) {
            $table
                ->addColumn('title_tag', 'string', ['limit' => 200, 'default' => null, 'null' => true,  'after' => 'use_in_search'])
                ->update();
        }

        $this->execute('ALTER TABLE feeder_homepages modify meta_description VARCHAR(200) charset utf8mb4');
        $this->execute('ALTER TABLE feeder_categories modify meta_description VARCHAR(200) charset utf8mb4');
        $this->execute('ALTER TABLE feeder_homepages modify title_tag VARCHAR(200) charset utf8mb4');
        $this->execute('ALTER TABLE feeder_categories modify title_tag VARCHAR(200) charset utf8mb4');
        $this->execute('UPDATE feeder_categories SET title_tag = name');
    }
}
