<?php
use Migrations\AbstractMigration;

class AddUploadedImageSizeField extends AbstractMigration
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
        $this->table('feeder_categories')
            ->addColumn('uploaded_image_size', 'integer', ['null' => true, 'default' => null, 'after' => 'image'])
            ->save();

        $this->table('feeder_fizzy_bubbles')
            ->addColumn('uploaded_image_size', 'integer', ['null' => true, 'default' => null, 'after' => 'image_src'])
            ->save();

        $this->table('feeder_pillar_pages')
            ->addColumn('uploaded_image_size', 'integer', ['null' => true, 'default' => null, 'after' => 'guide_image'])
            ->save();
    }
}
