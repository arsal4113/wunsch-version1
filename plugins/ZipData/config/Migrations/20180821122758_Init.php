<?php
use Migrations\AbstractMigration;

class Init extends AbstractMigration
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
        $table = $this->table('zip_data_zips');
        $table->addColumn('code', 'string')
            ->addColumn('city', 'string')
            ->addColumn('area', 'string')
            ->addIndex(['code'], ['unique' => false])
            ->save();
    }
}
