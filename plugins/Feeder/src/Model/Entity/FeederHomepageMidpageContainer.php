<?php
namespace Feeder\Model\Entity;

use Cake\ORM\Entity;

/**
 * FeederHomepageMidpageContainer Entity.
 *
 * @property int $id
 * @property int $homepage_id
 * @property string $video_desktop_mp4
 * @property string $video_tablet_mp4
 * @property string $video_mobile_mp4
 * @property string $video_desktop_webm
 * @property string $video_tablet_webm
 * @property string $video_mobile_webm
 * @property string $image_desktop
 * @property string $image_tablet
 * @property string $image_mobile
 * @property bool $use_video
 * @property string $click_url
 * @property string $header_text
 * @property string $button_text
 * @property string $button_color
 * @property string $background_color
 * @property FeederHomepage $feeder_homepage
 */
class FeederHomepageMidpageContainer extends Entity
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
        'homepage_id' => true,
        'video_desktop_mp4' => true,
        'video_tablet_mp4' => true,
        'video_mobile_mp4' => true,
        'video_desktop_webm' => true,
        'video_tablet_webm' => true,
        'video_mobile_webm' => true,
        'image_desktop' => true,
        'image_tablet' => true,
        'image_mobile' => true,
        'use_video' => true,
        'click_url' => true,
        'header_text' => true,
        'button_text' => true,
        'button_color' => true,
        'background_color' => true,
        'feeder_homepage' => true,
    ];
}
