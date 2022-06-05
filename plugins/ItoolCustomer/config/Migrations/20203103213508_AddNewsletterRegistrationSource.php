<?php

use Migrations\AbstractMigration;

/**
 * Class ModifyNewslettersTable
 */
class AddNewsletterRegistrationSource extends AbstractMigration
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
        $this->table('newsletters')
            ->addColumn('registration_source', 'string', [
                'limit' => 255,
                'null' => true,
                'default' => null,
                'after' => 'is_exportable'
            ])
            ->update();
    }
}
