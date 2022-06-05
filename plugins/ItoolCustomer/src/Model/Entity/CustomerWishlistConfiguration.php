<?php


namespace ItoolCustomer\Model\Entity;


use Cake\ORM\Entity;

/**
 * CustomerWishlistConfiguration Entity
 * @package ItoolCustomer\Model\Entity
 *
 * @property boolean randomize
 * @property int banner_products_factor
 * @property string banner_small_positions
 * @property string banner_large_positions
 */
class CustomerWishlistConfiguration extends Entity
{
    protected $_accessible = [
        'randomize' => true,
        'banner_products_factor' => true,
        'banner_small_positions' => true,
        'banner_large_positions' => true,
    ];
}