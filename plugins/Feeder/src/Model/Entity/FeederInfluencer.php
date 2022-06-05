<?php
namespace Feeder\Model\Entity;

use Cake\ORM\Entity;

/**
 * FeederInfluencer Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $url_path
 * @property string|null $title_tag
 * @property string|null $robot_tag
 * @property string|null $area_1_headline
 * @property string|null $area_1_text
 * @property string|null $area_2_text
 * @property string|null $area_2_link
 * @property string|null $area_3_image
 * @property string|null $area_3_video
 * @property string|null $area_5_text
 * @property string|null $area_5_image_1
 * @property string|null $area_5_image_2
 * @property string|null $area_5_image_3
 * @property string|null $area_5_image_4
 * @property string|null $area_5_image_5
 * @property string|null $area_5_image_6
 * @property string|null $area_6_image_1
 * @property string|null $area_6_image_2
 * @property string|null $area_6_image_3
 * @property string|null $area_7_text
 * @property string|null $area_7_text_mobile
 * @property string|null $area_8_image
 * @property string|null $area_8_headline_1
 * @property string|null $area_8_headline_2
 * @property string|null $area_8_subline
 * @property string|null $area_8_button_link
 * @property int|null $area_8_world_id
 * @property string|null $area_8_ig_name
 * @property string|null $area_8_ig_link
 * @property string|null $area_9_image
 * @property string|null $area_9_headline_1
 * @property string|null $area_9_headline_2
 * @property string|null $area_9_subline
 * @property string|null $area_9_button_link
 * @property int|null $area_9_world_id
 * @property string|null $area_9_ig_name
 * @property string|null $area_9_ig_link
 *
 * @property \Feeder\Model\Entity\FeederCategory $area8_world
 * @property \Feeder\Model\Entity\FeederCategory $area9_world
 * @property \Feeder\Model\Entity\FeederInfluencerMiniCategory[] $feeder_influencer_mini_categories
 */
class FeederInfluencer extends Entity
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
        'name' => true,
        'url_path' => true,
        'title_tag' => true,
        'meta_description' => true,
        'robot_tag' => true,
        'area_1_headline' => true,
        'area_1_text' => true,
        'area_2_text' => true,
        'area_2_link' => true,
        'area_3_image' => true,
        'area_3_video' => true,
        'area_5_text' => true,
        'area_5_image_1' => true,
        'area_5_image_2' => true,
        'area_5_image_3' => true,
        'area_5_image_4' => true,
        'area_5_image_5' => true,
        'area_5_image_6' => true,
        'area_6_image_1' => true,
        'area_6_image_2' => true,
        'area_6_image_3' => true,
        'area_7_text' => true,
        'area_7_text_mobile' => true,
        'area_8_image' => true,
        'area_8_headline_1' => true,
        'area_8_headline_2' => true,
        'area_8_subline' => true,
        'area_8_button_link' => true,
        'area_8_world_id' => true,
        'area_8_ig_name' => true,
        'area_8_ig_link' => true,
        'area_9_image' => true,
        'area_9_headline_1' => true,
        'area_9_headline_2' => true,
        'area_9_subline' => true,
        'area_9_button_link' => true,
        'area_9_world_id' => true,
        'area_9_ig_name' => true,
        'area_9_ig_link' => true,
        'area8_world' => true,
        'area9_world' => true,
        'feeder_influencer_mini_categories' => true,
    ];
}
