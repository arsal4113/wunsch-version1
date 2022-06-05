<?php
use Migrations\AbstractMigration;

class AddTopRatedBuyingExperienceToEbayCheckoutSessionItems extends AbstractMigration
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
        $table = $this->table('ebay_checkout_session_items');
        $table->addColumn('top_rated_buying_experience', 'boolean', ['after' => 'ebay_category_path','null' => true, 'default' => null]);
        $table->save();
    }
}
