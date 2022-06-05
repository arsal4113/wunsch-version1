<?php
namespace AclManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * Aro Entity.
 */
class Aro extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'parent_id' => true,
        'model' => true,
        'foreign_key' => true,
        'alias' => true,
        'lft' => true,
        'rght' => true,
        'parent_aro' => true,
        'child_aros' => true,
        'acos' => true,
    ];
}
