<?php
namespace Feeder\Model\Entity;

use Cake\ORM\Entity;

/**
 * FeederInterest Entity
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property int $sort_order
 * @property int $gender_id
 *
 * @property \Feeder\Model\Entity\FeederInterestSubcategory[] $feeder_interest_subcategories
 * @property \ItoolCustomer\Model\Entity\CustomerGender $customer_gender
 */
class FeederInterest extends Entity
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
        'image' => true,
        'sort_order' => true,
        'gender_id' => true,
        'feeder_interest_subcategories' => true,
        'customer_gender' => true
    ];
}
