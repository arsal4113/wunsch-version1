<?php
namespace Feeder\Model\Entity;

use Cake\ORM\Entity;

/**
 * FeederInfluencerMiniCategory Entity.
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $url
 * @property string|null $image
 * @property int $feeder_influencer_id
 */
class FeederInfluencerMiniCategory extends Entity
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
        'url' => true,
        'image' => true,
        'feeder_influencer_id' => true,
        'feeder_influencer' => true,
    ];
}
