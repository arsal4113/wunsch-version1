<?php
namespace Feeder\Model\Entity;

use Cake\ORM\Entity;

/**
 * FeederHomepage Entity
 *
 * @property int $id
 * @property string $main_logo
 * @property string $time_logo
 * @property \Cake\I18n\Time $logo_start_time
 * @property \Cake\I18n\Time $logo_end_time
 * @property string $big_banner_image
 * @property string $big_banner_link
 * @property string $first_small_banner_image
 * @property string $first_small_banner_link
 * @property string $second_small_banner_image
 * @property string $second_small_banner_link
 * @property string $third_small_banner_image
 * @property string $third_small_banner_link
 * @property string $fourth_small_banner_image
 * @property string $fourth_small_banner_link
 * @property string $surprise_item_ids
 * @property string $h1
 * @property string $h2
 * @property bool $randomize_surprise_item_ids
 * @property bool $activate_newsletter_popup
 * @property int $feeder_category_id
 * @property int $mini_cart_feeder_category_id
 * @property string meta_robots_tag
 * @property \Feeder\Model\Entity\FeederCategory $feeder_category
 * @property \Feeder\Model\Entity\FeederHomepageMidpageContainer $feeder_homepage_midpage_container
 */
class FeederHomepage extends Entity
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
        'main_logo' => true,
        'time_logo' => true,
        'logo_start_time' => true,
        'logo_end_time' => true,

        'big_banner_image' => true,
        'big_banner_link' => true,

        'first_small_banner_image' => true,
        'first_small_banner_link' => true,

        'second_small_banner_image' => true,
        'second_small_banner_link' => true,

        'third_small_banner_image' => true,
        'third_small_banner_link' => true,

        'fourth_small_banner_image' => true,
        'fourth_small_banner_link' => true,

        'surprise_item_ids' => true,
        'randomize_surprise_item_ids' => true,
    	'activate_newsletter_popup' => true,
        'feeder_category_id' => true,
        'feeder_category' => true,
        'mini_cart_feeder_category_id' => true,
        'meta_description' => true,
        'title_tag' => true,
        'meta_robots_tag' => true,
        'h1' => true,
        'h2' => true,
        'feeder_homepage_midpage_container' => true
    ];
}
