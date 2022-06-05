<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * CoreUser Entity.
 */
class CoreUser extends Entity
{

    /**
     * SuperUser Ident Id
     *
     * @var integer
     */
    const SUPER_USER = 42;

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'is_super_user' => false,
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

    /**
     * Hash password
     *
     * @param string $password
     * @return string hashed password
     */
    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher())->hash($password);
    }
}
