<?php
namespace Feeder\Model\Entity;

use Cake\ORM\Entity;

/**
 * FeederCategoriesVideoElement Entity.
 *
 * @property int $id
 * @property bool $is_active
 * @property string|null $video_mp4
 * @property string|null $video_webm
 * @property string|null $background_color
 * @property string|null $headline
 * @property string|null $headline_color
 */
class FeederCategoriesVideoElement extends Entity
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
        'is_active' => true,
        'video_mp4' => true,
        'video_webm' => true,
        'background_color' => true,
        'headline' => true,
        'headline_color' => true,
    ];
}
