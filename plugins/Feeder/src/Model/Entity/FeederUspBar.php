<?php
namespace Feeder\Model\Entity;

use Cake\ORM\Entity;

/**
 * FeederUspBar Entity
 *
 * @property int $id
 * @property string $usp_text
 * @property int $sort_order
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $created
 */
class FeederUspBar extends Entity
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
        'usp_text' => true,
        'sort_order' => true,
        'modified' => true,
        'created' => true
    ];
}
