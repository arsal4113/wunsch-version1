<?php

use Migrations\AbstractMigration;

class AddAnimatedHeaderFlagCatagories extends AbstractMigration
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
        $table = $this->table('feeder_categories');
        
        if (!$table->hasColumn('has_animated_header'))
        {
        	$table->addColumn('has_animated_header', 'boolean', [
        			'default' => false,
        			'after' => 'is_invisible'])
        		  ->update();
        }
        
        if (!$table->hasColumn('animated_header_custom_style'))
        {
        	$table->addColumn('animated_header_custom_style', 'text', [
        			'null' => true,
        			'default' => null,
        			'after' => 'has_animated_header'])
        			->update();
        }
        
        if (!$table->hasColumn('animated_header_text_title'))
        {
        	$table->addColumn('animated_header_text_title', 'text', [
        			'null' => true,
        			'default' => null,
        			'after' => 'animated_header_custom_style'])
        		  ->update();
        }
        
        if (!$table->hasColumn('animated_header_text_title_color'))
        {
        	$table->addColumn('animated_header_text_title_color', 'text', [
        			'null' => true,
        			'default' => null,
        			'after' => 'animated_header_text_title'])
        		  ->update();
        }
        
        if (!$table->hasColumn('animated_header_text_subtitle'))
        {
        	$table->addColumn('animated_header_text_subtitle', 'text', [
        			'null' => true,
        			'default' => null,
        			'after' => 'animated_header_text_title_color'])
        		  ->update();
        }
        
        if (!$table->hasColumn('animated_header_text_subtitle_color'))
        {
        	$table->addColumn('animated_header_text_subtitle_color', 'text', [
        			'null' => true,
        			'default' => null,
        			'after' => 'animated_header_text_subtitle'])
        		  ->update();
        }
        
        if (!$table->hasColumn('animated_header_first_background_color'))
        {
        	$table->addColumn('animated_header_first_background_color', 'text', [
        			'null' => true,
        			'default' => null,
        			'after' => 'animated_header_text_subtitle'])
        		  ->update();
        }
        
        if (!$table->hasColumn('animated_header_second_background_color'))
        {
        	$table->addColumn('animated_header_second_background_color', 'text', [
        			'null' => true,
        			'default' => null,
        			'after' => 'animated_header_first_background_color'])
        	      ->update();
        }
        
        if (!$table->hasColumn('animated_header_third_background_color'))
        {
        	$table->addColumn('animated_header_third_background_color', 'text', [
        			'null' => true,
        			'default' => null,
        			'after' => 'animated_header_second_background_color'])
        			->update();
        }
        
        if (!$table->hasColumn('animated_header_image'))
        {
        	$table->addColumn('animated_header_image', 'text', [
        			'null' => true,
        			'default' => null,
        			'after' => 'animated_header_third_background_color'])
        	      ->update();
        }
        
        if (!$table->hasColumn('animated_header_background_animation_type'))
        {
        	$table->addColumn('animated_header_background_animation_type', 'text', [
        			'null' => true,
        			'default' => null,
        			'after' => 'animated_header_image'])
        		  ->update();
        }
        
        if (!$table->hasColumn('animated_header_end_time')) {
        	$table->addColumn('animated_header_end_time', 'datetime', [
        		'default' => null,
        		'null' => true,
        		'after' => 'animated_header_background_animation_type'
        	])->update();
        }
        
        if (!$table->hasColumn('animated_header_end_time_color')) {
        	$table->addColumn('animated_header_end_time_color', 'text', [
        			'default' => null,
        			'null' => true,
        			'after' => 'animated_header_end_time'
        	])->update();
        }
        
        if (!$table->hasColumn('animated_header_name_color')) {
        	$table->addColumn('animated_header_name_color', 'text', [
        			'default' => null,
        			'null' => true,
        			'after' => 'animated_header_end_time_color'
        	])->update();
        }
        
        if (!$table->hasColumn('animated_header_box_color')) {
        	$table->addColumn('animated_header_box_color', 'text', [
        			'default' => null,
        			'null' => true,
        			'after' => 'animated_header_name_color'
        	])->update();
        }
        
        if (!$table->hasColumn('animated_header_number_color')) {
        	$table->addColumn('animated_header_number_color', 'text', [
        			'default' => null,
        			'null' => true,
        			'after' => 'animated_header_box_color'
        	])->update();
        }
        
        if (!$table->hasColumn('animated_header_tile_color')) {
        	$table->addColumn('animated_header_tile_color', 'text', [
        			'default' => null,
        			'null' => true,
        			'after' => 'animated_header_number_color'
        	])->update();
        }
    }
}
