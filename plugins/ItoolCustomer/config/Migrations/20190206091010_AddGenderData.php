<?php
use Migrations\AbstractMigration;

class AddGenderData extends AbstractMigration
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
        if (!$this->hasTable('customer_genders')) {
            $this->table('customer_genders')
                ->addColumn('gender', 'string', ['null' => false])
                ->create();

            $data = [
                ['gender' => 'all'],
                ['gender' => 'male'],
                ['gender' => 'female']
            ];

            $this->insert('customer_genders', $data);
        }
    }
}
