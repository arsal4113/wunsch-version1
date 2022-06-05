<?php
namespace ZipData\Model\Entity;

use Cake\ORM\Entity;

/**
 * ZipDataZip Entity.
 *
 * @property int $id
 * @property string $code
 * @property string $city
 * @property string $area
 * @property int $last_import
 * @property string $search_hash
 */
class ZipDataZip extends Entity
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
        'code' => true,
        'city' => true,
        'area' => true,
        'last_import' => true,
        'search_hash' => true
    ];
}
