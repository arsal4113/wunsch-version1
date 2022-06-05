<?php
namespace Ebay\Model\Entity;

use Cake\ORM\Entity;

/**
 * EbaySite Entity.
 */
class EbaySite extends Entity
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
