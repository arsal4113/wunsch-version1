<?php
use Migrations\AbstractMigration;

class AddOriginToCheckout extends AbstractMigration
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
        $this->table('ebay_checkouts')
            ->addColumn('x_frame_origins', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
                'after' => 'title'
            ])->update();
    }
}
