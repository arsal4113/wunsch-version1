<?php

use Migrations\AbstractMigration;

class AddEbayCheckoutSessionWL extends AbstractMigration
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
    	$table = $this->table('ebay_checkout_sessions');
    	
    	if (!$table->hasColumn('wrapper_layout')) {
    		
    		$options = [
    			'default' => null,
    			'limit' => 510,
    			'null' => true,
    			'after' => 'ebay_global_id'
    		];
    		
    		$table->addColumn('wrapper_layout', 'string', $options)->update();
    	}
    }
}
