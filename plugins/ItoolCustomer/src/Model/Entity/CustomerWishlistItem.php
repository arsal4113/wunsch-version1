<?php
namespace ItoolCustomer\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomerWishlistItem Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property string $name
 * @property string $image
 * @property int $delivery_duration_de
 * @property int $delivery_cost_de
 * @property string $eek
 * @property string $seller
 * @property string $ebay_item_id
 * @property int $quantity
 * @property float $price
 * @property float $original_price
 * @property string $currency
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property bool $is_deleted
 *
 * @property \ItoolCustomer\Model\Entity\Customer $customer
 */
class CustomerWishlistItem extends Entity
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
        'customer_id' => true,
        'name' => true,
        'image' => true,
        'quantity' => true,
        'delivery_duration_de' => true,
        'delivery_cost_de' => true,
        'category_id' => true,
        'eek' => true,
        'seller' => true,
        'ebay_item_id' => true,
        'price' => true,
        'original_price' => true,
        'currency' => true,
        'created' => true,
        'modified' => true,
        'is_deleted' => true,
        'customer' => true
    ];
}
