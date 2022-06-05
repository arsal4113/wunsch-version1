<?php

use Phinx\Migration\AbstractMigration;

class UpdateEbayCategorySpecifics extends AbstractMigration
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
        // Set foreign key in ebay_category_specifics
        if($this->hasTable('ebay_category_specifics')) {
            $this->execute('TRUNCATE TABLE `ebay_category_specifics`');
            $table = $this->table('ebay_category_specifics');
            $table
                ->addForeignKey('ebay_category_id', 'ebay_categories', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
                ->update();
        }
        
        // Set foreign key in ebay_category_specific_value_recommendations
        if($this->hasTable('ebay_category_specific_value_recommendations')) {
            $this->execute('TRUNCATE TABLE `ebay_category_specific_value_recommendations`');
            $table = $this->table('ebay_category_specific_value_recommendations');
            $table
                ->addForeignKey('ebay_site_id', 'ebay_sites', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
                ->update();
        }
        
        // Set foreign key in ebay_category_specific_to_value_recommendations
        if($this->hasTable('ebay_category_specific_to_value_recommendations')) {
            $this->execute('TRUNCATE TABLE `ebay_category_specific_to_value_recommendations`');
            $table = $this->table('ebay_category_specific_to_value_recommendations');
            $table
                ->removeIndex(['ebay_category_specific_id'])
                ->addIndex(['ebay_category_specific_id'])
                ->addIndex(['ebay_category_specific_value_recommendation_id'])
                ->addForeignKey('ebay_category_specific_id', 'ebay_category_specifics', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
                ->addForeignKey('ebay_category_specific_value_recommendation_id', 'ebay_category_specific_value_recommendations', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
                ->update();
        }        
    }
}
