<?php

use Migrations\AbstractMigration;

class AddActivateNewsletterPopupBoolean extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('feeder_homepages');
        
        if (!$table->hasColumn('activate_newsletter_popup'))
        {
            $table->addColumn('activate_newsletter_popup', 'boolean', [
            	'default' => true,
            	'null' => false,
            	'after' => 'randomize_surprise_item_ids'
            ])->update();
        }
    }
}
