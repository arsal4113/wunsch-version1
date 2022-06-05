<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CoreUserRole Entity.
 */
class CoreUserRole extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'core_seller_id' => true,
        'code' => true,
        'name' => true,
        'core_seller' => true,
        'core_users' => true,
    ];
    
    /**
     * Get parent node
     * 
     * @return NULL
     */
    public function parentNode() 
    {
    	return null;
    }
}
