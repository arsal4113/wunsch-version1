<?php
use Migrations\AbstractMigration;

class AddImageTags extends AbstractMigration
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
        $tableColumns = [
            'feeder_homepage_banners' => ['banner_image'],
            'feeder_hero_items' => ['image'],
            'feeder_categories' => ['image', 'background']
        ];

        foreach ($tableColumns as $tableName => $images) {
            foreach ($images as $image) {
                $table = $this->table($tableName);
                $altTag = $image . '_alt_tag';
                $titleTag = $image . '_title_tag';
                if (!$table->hasColumn($altTag) || !$table->hasColumn($titleTag)) {
                    $table->addColumn($altTag, 'text', ['after' => $image])
                        ->addColumn($titleTag, 'text', ['after' => $altTag])
                        ->update();
                }
            }
        }
    }
}
