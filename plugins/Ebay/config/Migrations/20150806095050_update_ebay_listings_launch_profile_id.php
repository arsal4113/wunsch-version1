<?php

use Phinx\Migration\AbstractMigration;

class UpdateEbayListingsLaunchProfileId extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function change()
    {
        $table = $this->table('ebay_listings');
        $table
            ->addColumn('ebay_launch_profile_id', 'integer', array(
                'limit' => 11,
                'null' => true,
                'after' => 'id'
            ))
            ->addIndex(['ebay_launch_profile_id'])
            ->addForeignKey('ebay_launch_profile_id', 'ebay_launch_profiles', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->update();
    }
}
