<?php
use Migrations\AbstractMigration;

class FeederCategoryBannersTextColor extends AbstractMigration
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
        $table = $this->table('feeder_categories');

        if (!$table->hasColumn('headline_font_color')) {
            $table->addColumn('headline_font_color', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
                'after' => 'name'

            ])->update();
        }
        if (!$table->hasColumn('caption_font_color')) {
            $table->addColumn('caption_font_color', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
                'after' => 'caption'
            ])->update();
        }

        if (!$table->hasColumn('text_background_color')) {
            $table->addColumn('text_background_color', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
                'after' => 'caption_font_color'
            ])->update();
        }
        if (!$table->hasColumn('opacity')) {
            $table->addColumn('opacity', 'integer', [
                'default' => 100,
                'limit' => 100,
                'null' => false,
                'after' => 'text_background_color'
            ])->update();
        }
    }

}
