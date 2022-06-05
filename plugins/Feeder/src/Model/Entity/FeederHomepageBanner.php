<?php
namespace Feeder\Model\Entity;

use Cake\ORM\Entity;

/**
 * FeederHomepageBanner Entity
 *
 * @property int $id
 * @property int $feeder_homepage_id
 * @property string $banner_image
 * @property string $banner_image_alt_tag
 * @property string $banner_image_title_tag
 * @property string $banner_link
 * @property string $banner_bp_lg
 * @property string $banner_bp_md
 * @property string $banner_bp_sm
 * @property string $banner_bp_xs
 * @property string $headline
 * @property string $headline_font_color
 * @property string $caption
 * @property string $caption_font_color
 * @property string $text_background_color
 * @property int $opacity
 * @property string $cta
 * @property string $cta_color
 * @property string $loader_color
 * @property int $sort_order
 * @property \Cake\I18n\Time $start_time
 * @property \Cake\I18n\Time $end_time
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $created
 *
 * @property \Feeder\Model\Entity\FeederHomepage $feeder_homepage
 */
class FeederHomepageBanner extends Entity
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
        'feeder_homepage_id' => true,
        'banner_image' => true,
        'banner_image_alt_tag' => true,
        'banner_image_title_tag' => true,
        'banner_link' => true,
        'banner_bp_lg' => true,
        'banner_bp_md' => true,
        'banner_bp_sm' => true,
        'banner_bp_xs' => true,
        'headline' => true,
        'headline_font_color' => true,
        'caption' => true,
        'caption_font_color' => true,
        'text_background_color' => true,
        'opacity' => true,
        'cta' => true,
        'cta_color' => true,
        'loader_color' => true,
        'sort_order' => true,
        'start_time' => true,
        'end_time' => true,
        'modified' => true,
        'created' => true,
        'feeder_homepage' => true
    ];
}
