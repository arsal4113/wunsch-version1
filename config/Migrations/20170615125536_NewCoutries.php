<?php
use Migrations\AbstractMigration;

class NewCoutries extends AbstractMigration
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
        $data = [
            [
                'iso_code' => 'RU',
                'name' => 'Russia',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'UA',
                'name' => 'Ukraine',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'IL',
                'name' => 'Israel',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ],
            [
                'iso_code' => 'MT',
                'name' => 'Malta',
                'default_tax' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ]
        ];

        $this->insert('core_countries', $data);
    }
}
