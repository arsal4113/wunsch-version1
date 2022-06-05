<?php

use Phinx\Migration\AbstractMigration;

class EbayDisputes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     */
    public function change() {
    	
    	if(!$this->hasTable('ebay_dispute_reasons')) {
    		$table = $this->table('ebay_dispute_reasons')
    		->addColumn('code', 'string', array('limit' => '100'))
    		->addColumn('created', 'datetime')
    		->addColumn('modified', 'datetime')
    		->addIndex('code')
    		->create();
    		
    		$this->execute("INSERT INTO `ebay_dispute_reasons` (`id`, `code`, `created`, `modified`) VALUES
    			(1, 'BuyerHasNotPaid', now(), now()),
    			(2, 'TransactionMutuallyCanceled', now(), now());"
    		);
    	}
    	
    	if(!$this->hasTable('ebay_dispute_reason_names')) {
    		$table = $this->table('ebay_dispute_reason_names')
    		->addColumn('ebay_dispute_reason_id', 'integer', array('limit' => '10'))
    		->addColumn('core_language_id', 'integer', array('limit' => '10'))
    		->addColumn('name', 'string', array('limit' => '100'))
    		->addColumn('created', 'datetime')
    		->addColumn('modified', 'datetime')
    		->addIndex('ebay_dispute_reason_id')
    		->addIndex('core_language_id')
    		->create();
    		
    		$this->execute("INSERT INTO `ebay_dispute_reason_names` (`id`, `ebay_dispute_reason_id`, `core_language_id`, `name`, `created`, `modified`) VALUES
    			(NULL, 1, 1, 'BuyerHasNotPaid', now(), now()),
    			(NULL, 2, 1, 'TransactionMutuallyCanceled', now(), now());"
    		);
    	}
    	
    	if(!$this->hasTable('ebay_dispute_explanations')) {
    		$table = $this->table('ebay_dispute_explanations')
    		->addColumn('code', 'string', array('limit' => '100'))
    		->addColumn('created', 'datetime')
    		->addColumn('modified', 'datetime')
    		->addIndex('code')
    		->create();
    		
    		$this->execute("INSERT INTO `ebay_dispute_explanations` (`id`, `code`, `created`, `modified`) VALUES
    			(1, 'BuyerHasNotResponded', now(), now()),
    			(2, 'BuyerNoLongerWantsItem', now(), now()),
    			(3, 'BuyerNotClearedToPay', now(), now()),
    			(4, 'BuyerNotPaid', now(), now()),
    			(5, 'BuyerPaymentNotReceivedOrCleared', now(), now()),
    			(6, 'BuyerPurchasingMistake', now(), now()),
    			(7, 'BuyerRefusedToPay', now(), now()),
    			(8, 'BuyerReturnedItemForRefund', now(), now()),
    			(9, 'OtherExplanation', now(), now()),
    			(10, 'SellerDoesntShipToCountry', now(), now()),
    			(11, 'SellerRanOutOfStock', now(), now()),
    			(12, 'ShippingAddressNotConfirmed', now(), now()),
    			(13, 'UnableToResolveTerms', now(), now());"
    		);
    	}
    	
    	if(!$this->hasTable('ebay_dispute_explanation_names')) {
    		$table = $this->table('ebay_dispute_explanation_names')
    		->addColumn('ebay_dispute_explanation_id', 'integer', array('limit' => '10'))
    		->addColumn('core_language_id', 'integer', array('limit' => '10'))
    		->addColumn('name', 'string', array('limit' => '100'))
    		->addColumn('created', 'datetime')
    		->addColumn('modified', 'datetime')
    		->addIndex('ebay_dispute_explanation_id')
    		->addIndex('core_language_id')
    		->create();
    		
    		$this->execute("INSERT INTO `ebay_dispute_explanation_names` (`id`, `ebay_dispute_explanation_id`, `core_language_id`, `name`, `created`, `modified`) VALUES
    			(NULL, 1, 1, 'BuyerHasNotResponded', now(), now()),
    			(NULL, 2, 1, 'BuyerNoLongerWantsItem', now(), now()),
    			(NULL, 3, 1, 'BuyerNotClearedToPay', now(), now()),
    			(NULL, 4, 1, 'BuyerNotPaid', now(), now()),
    			(NULL, 5, 1, 'BuyerPaymentNotReceivedOrCleared', now(), now()),
    			(NULL, 6, 1, 'BuyerPurchasingMistake', now(), now()),
    			(NULL, 7, 1, 'BuyerRefusedToPay', now(), now()),
    			(NULL, 8, 1, 'BuyerReturnedItemForRefund', now(), now()),
    			(NULL, 9, 1, 'OtherExplanation', now(), now()),
    			(NULL, 10, 1, 'SellerDoesntShipToCountry', now(), now()),
    			(NULL, 11, 1, 'SellerRanOutOfStock', now(), now()),
    			(NULL, 12, 1, 'ShippingAddressNotConfirmed', now(), now()),
    			(NULL, 13, 1, 'UnableToResolveTerms', now(), now());"
    		);
    	}
    	
    	if(!$this->hasTable('ebay_dispute_explanations_ebay_dispute_reasons')) {
    		$table = $this->table('ebay_dispute_explanations_ebay_dispute_reasons')
    		->addColumn('ebay_dispute_explanation_id', 'integer', array('limit' => '10'))
    		->addColumn('ebay_dispute_reason_id', 'integer', array('limit' => '10'))
    		->addColumn('created', 'datetime')
    		->addColumn('modified', 'datetime')
    		->addIndex('ebay_dispute_reason_id')
    		->addIndex('ebay_dispute_explanation_id')
    		->create();
    		
    		$this->execute("INSERT INTO `ebay_dispute_explanations_ebay_dispute_reasons` (`id`, `ebay_dispute_explanation_id`, `ebay_dispute_reason_id`, `created`, `modified`) VALUES
    			(NULL, 1, 1, now(), now()),
    			(NULL, 2, 2, now(), now()),
    			(NULL, 3, 1, now(), now()),
    			(NULL, 4, 1, now(), now()),
    			(NULL, 5, 1, now(), now()),
    			(NULL, 6, 2, now(), now()),
    			(NULL, 7, 1, now(), now()),
    			(NULL, 8, 2, now(), now()),
    			(NULL, 9, 1, now(), now()),
    			(NULL, 9, 2, now(), now()),
    			(NULL, 10, 1, now(), now()),
    			(NULL, 10, 2, now(), now()),	
    			(NULL, 11, 2, now(), now()),
    			(NULL, 12, 1, now(), now()),
    			(NULL, 12, 2, now(), now()),	
    			(NULL, 13, 2, now(), now());"
    		);
    	}
    }
    
    
    /**
     * Migrate Up.
     */
    public function up()
    {
    
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}