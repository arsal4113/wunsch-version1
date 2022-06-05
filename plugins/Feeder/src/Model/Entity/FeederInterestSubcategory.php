<?php
namespace Feeder\Model\Entity;

use Cake\ORM\Entity;

/**
 * FeederInterestSubcategory Entity
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $ids
 * @property bool $sale_only
 *
 * @property \Feeder\Model\Entity\FeederInterest[] $feeder_interests
 * @property \ItoolCustomer\Model\Entity\Customer[] $customers
 */
class FeederInterestSubcategory extends Entity
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
        'type' => true,
        'ids' => true,
        'sale_only' => true,
        'feeder_interests' => true,
        'customers' => true
    ];
}
