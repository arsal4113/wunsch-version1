<?php
use Migrations\AbstractMigration;

class AddLogoField extends AbstractMigration
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
        $productVisits = $this->table('product_visits');
        $productVisits
            ->addColumn('catch_logo', 'string', [
                'limit' => 200,
                'after' => 'hits',
                'default' => null,
                'null' => false,
            ])
        ->save();
    }
}
