<?php

use Migrations\AbstractMigration;

class CategoryBanner extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('feeder_categories');

        if (!$table->hasColumn('banner_image'))
        {
        	$table->addColumn('banner_image', 'string', [
                'limit' => 510,
                'null' => true,
                'after' => 'is_invisible'
            ]);
        }

        if (!$table->hasColumn('banner_image_alt_tag'))
        {
        	$table->addColumn('banner_image_alt_tag', 'text', [
                'limit' => 200,
                'default' => null,
                'null' => true,
                'after' => 'banner_image'
            ]);
        }

        if (!$table->hasColumn('banner_image_title_tag'))
        {
        	$table->addColumn('banner_image_title_tag', 'text', [
                'limit' => 200,
                'default' => null,
                'null' => true,
                'after' => 'banner_image_alt_tag'
            ]);
        }

        if (!$table->hasColumn('banner_url'))
        {
        	$table->addColumn('banner_url', 'string', [
                'limit' => 1024,
                'after' => 'banner_image_title_tag'

            ]);
        }

        $table->update();
    }
}
