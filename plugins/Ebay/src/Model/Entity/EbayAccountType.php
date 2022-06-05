<?php
namespace Ebay\Model\Entity;

use Cake\ORM\Entity;

/**
 * EbayAccountType Entity.
 */
class EbayAccountType extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
