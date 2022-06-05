<?php
use Migrations\AbstractMigration;

class UpdateEAVIndexes extends AbstractMigration
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
        $this->table('core_product_attribute_value_datetimes')
            ->addIndex(['value'])
            ->save();

        $this->table('core_product_attribute_value_decimals')
            ->addIndex(['value'])
            ->save();

        $this->table('core_product_attribute_value_images')
            ->addIndex(['value'])
            ->save();

        $this->table('core_product_attribute_value_ints')
            ->addIndex(['value'])
            ->save();
        $this->table('core_product_attribute_value_varchars')
            ->addIndex(['value'])
            ->save();
    }
}
