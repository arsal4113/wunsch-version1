<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CoreConfiguration Entity.
 */
class CoreConfiguration extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'core_seller_id' => true,
        'configuration_group' => true,
        'configuration_path' => true,
        'configuration_value' => true,
        'core_seller' => true,
    ];
}
