<?php
use Migrations\AbstractMigration;

class UpdateCoreSellers extends AbstractMigration
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
        $this->table('core_sellers')
            ->addColumn('code', 'string', ['limit' => 100, 'after' => 'id'])
            ->update();
    }
}
