<?php

namespace Feeder\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * FeederCategory Entity
 *
 * @property int $id
 * @property int $parent_id
 * @property int $lft
 * @property int $rght
 * @property int $level
 * @property string $name
 * @property string $category_type
 * @property string $template_type
 * @property string $url_path
 * @property string $headline
 * @property string $headline_guide
 * @property string $headline_font_color
 * @property string $caption
 * @property string $caption_font_color
 * @property string $text_background_color
 * @property int $opacity
 * @property string $item_id
 * @property string $image
 * @property int $uploaded_image_size
 * @property string $image_alt_tag
 * @property string $image_title_tag
 * @property string $image_selected
 * @property string $background
 * @property string $background_alt_tag
 * @property string $background_title_tag
 * @property string $background_color
 * @property int random_skip
 * @property int banner_products_factor
 * @property string banner_small_positions
 * @property string banner_large_positions
 * @property int randomize
 * @property bool sort_by_input_sequence
 * @property string $ebay_category_id
 * @property string $top_category_id
 * @property string $gtin
 * @property string $keywords
 * @property string $exclude_keywords
 * @property string $seller_account_type
 * @property string $seller_trusted_level
 * @property string $listing_type
 * @property string $items_condition
 * @property string $include_seller
 * @property string $exclude_seller
 * @property int $qty
 * @property float $price_from
 * @property float $price_to
 * @property boolean $only_with_sales_prices
 * @property int $sort_order
 * @property boolean $use_in_search
 * @property boolean $is_invisible
 * @property string $banner_image
 * @property string $banner_image_alt_tag
 * @property string $banner_image_title_tag
 * @property string $banner_image_selected
 * @property boolean $has_animated_header
 * @property string animated_header_custom_style
 * @property string animated_header_text_title
 * @property string animated_header_text_title_text
 * @property string animated_header_text_subtitle
 * @property string animated_header_text_subtitle_color
 * @property string animated_header_first_background_color
 * @property string animated_header_second_background_color
 * @property string animated_header_third_background_color
 * @property string animated_header_image
 * @property string animated_header_background_animation_type
 * @property string animated_header_end_time
 * @property string animated_header_end_time_color
 * @property string animated_header_name_color
 * @property string animated_header_box_color
 * @property string animated_header_number_color
 * @property string animated_header_tile_color
 * @property string meta_description
 * @property string footer_text
 * @property string facebook_og_url
 * @property string facebook_og_type
 * @property string facebook_og_title
 * @property string facebook_og_description
 * @property string facebook_og_image
 * @property string title_tag
 * @property string robot_tag
 * @property int feeder_categories_video_element_id
 * @property integer canonical_link_category_id
 * @property \Cake\I18n\Time $start_time
 * @property \Cake\I18n\Time $end_time
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $created
 *
 * @property \Feeder\Model\Entity\FeederCategory $parent_feeder_category
 * @property \Feeder\Model\Entity\FeederCategory[] $child_feeder_categories
 * @property \Feeder\Model\Entity\FeederHeroItem[] $feeder_hero_items
 * @property \App\Model\Entity\CoreCountry[] $core_countries
 * @property FeederCategoriesVideoElement $feeder_categories_video_element
 */
class FeederCategory extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'parent_id' => true,
        'lft' => true,
        'rght' => true,
        'level' => true,
        'name' => true,
        'category_type' => true,
        'template_type' => true,
        'url_path' => true,
        'headline' => true,
        'headline_guide' => true,
        'headline_font_color' => true,
        'caption' => true,
        'caption_font_color' => true,
        'text_background_color' => true,
        'opacity' => true,
        'item_id' => true,
        'image' => true,
        'uploaded_image_size' => true,
        'image_alt_tag' => true,
        'image_title_tag' => true,
        'image_selected' => true,
        'background' => true,
        'background_alt_tag' => true,
        'background_title_tag' => true,
        'background_color' => true,
        'random_skip' => true,
        'banner_products_factor' => true,
        'banner_small_positions' => true,
        'banner_large_positions' => true,
        'randomize' => true,
        'sort_by_input_sequence' => true,
        'ebay_category_id' => true,
        'top_category_id' => true,
        'gtin' => true,
        'keywords' => true,
        'exclude_keywords' => true,
        'seller_account_type' => true,
        'seller_trusted_level' => true,
        'listing_type' => true,
        'items_condition' => true,
        'include_seller' => true,
        'exclude_seller' => true,
        'qty' => true,
        'price_from' => true,
        'price_to' => true,
        'only_with_sales_prices' => true,
        'start_time' => true,
        'end_time' => true,
        'sort_order' => true,
        'use_in_search' => true,
        'is_invisible' => true,
    	'banner_image' => true,
    	'banner_image_alt_tag' => true,
    	'banner_image_title_tag' => true,
    	'banner_url' => true,
    	'has_animated_header' => true,
    	'animated_header_custom_style' => true,
    	'animated_header_text_title' => true,
    	'animated_header_text_title_color' => true,
    	'animated_header_text_subtitle' => true,
    	'animated_header_text_subtitle_color' => true,
    	'animated_header_first_background_color' => true,
    	'animated_header_second_background_color' => true,
    	'animated_header_third_background_color' => true,
    	'animated_header_image' => true,
    	'animated_header_background_animation_type' => true,
    	'animated_header_end_time' => true,
    	'animated_header_end_time_color' => true,
    	'animated_header_name_color' => true,
		'animated_header_box_color' => true,
		'animated_header_number_color' => true,
		'animated_header_tile_color' => true,
        'modified' => true,
        'created' => true,
        'meta_description' => true,
        'footer_text' => true,
        'title_tag' => true,
        'facebook_og_url' => true,
        'facebook_og_type' => true,
        'facebook_og_title' => true,
        'facebook_og_description' => true,
        'facebook_og_image' => true,
        'robot_tag' => true,
        'canonical_link_category_id' => true,
        'parent_feeder_category' => true,
        'child_feeder_categories' => true,
        'feeder_hero_items' => true,
        'core_countries' => true,
        'feeder_categories_video_element_id' => true,
        'feeder_categories_video_element' => true,
    ];

    protected function _getUploadedImageSize($uploadedImageSize)
    {
        if ($uploadedImageSize === null || $this->isDirty()) {
            $fields = ['image', 'banner_image', 'animated_header_image'];
            $images = [];
            foreach ($fields as $field) {
                isset($this->{$field}) && $images[] = $this->{$field};
            }

            $uploadedImageSize = 0;
            foreach ($images as $image) {
                if (file_exists(WWW_ROOT . 'img' . DS . $image)) {
                    $uploadedImageSize += filesize(WWW_ROOT . 'img' . DS . $image);
                } else if (!empty($image)){
                    $uploadedImageSize += @get_headers($image, true)['Content-Length'] ?? 0;
                }
            }
            $connection = \Cake\Datasource\ConnectionManager::get('default');
            $connection->update('feeder_categories', ['uploaded_image_size' => $uploadedImageSize], ['id' => $this->id]);
            $this->setDirty('uploaded_image_size', false);
        }
        return $uploadedImageSize;
    }
}
