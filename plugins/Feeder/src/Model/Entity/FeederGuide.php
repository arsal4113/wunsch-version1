<?php
namespace Feeder\Model\Entity;

use Cake\ORM\Entity;

/**
 * FeederGuide Entity
 *
 * @property int $id
 * @property string|null $url
 * @property string|null $title
 * @property string|null $description
 * @property string $first_background_image
 * @property string $second_background_image
 * @property int $display_animation
 * @property string $animation_image
 * @property string $background_color
 * @property string meta_title
 * @property string robots_tag
 * @property string meta_description
 * @property int $use_in_navigation
 * @property string $navigation_name
 * @property int $sort_order
 * @property string $optional_urls
 * @property string $optional_url_headers
 * @property string $optional_url_image
 *
 * @property \Feeder\Model\Entity\FeederCategory[] $feeder_categories
 * @property \Feeder\Model\Entity\FeederPillarPage[] $feeder_pillar_pages
 */
class FeederGuide extends Entity
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
        'url' => true,
        'meta_title' => true,
        'robots_tag' => true,
        'meta_description' => true,
        'title' => true,
        'description' => true,
        'first_background_image' => true,
        'second_background_image' => true,
        'display_animation' => true,
        'animation_image' => true,
        'background_color' => true,
        'use_in_navigation' => true,
        'navigation_name' => true,
        'sort_order' => true,
        'optional_urls' => true,
        'optional_url_headers' => true,
        'optional_url_image' => true,
        'feeder_categories' => true,
        'feeder_pillar_pages' => true
    ];
    
    function getImgPath($img)
    {
        if (isset($img)) {
            return strpos($img, '://') === false ? 'img/' . $img : $img;
        }
        return null;
    }
    
}
