<?php
namespace EbayCheckout\Model\Entity;

use Cake\ORM\Entity;

/**
 * EbayCheckoutSessionShippingAddress Entity
 *
 * @property int $id
 * @property int $ebay_checkout_session_id
 * @property string $recipient
 * @property string $address_line_1
 * @property string $address_line_2
 * @property string $city
 * @property string $country
 * @property string $phone_number
 * @property int $random_phone_number
 * @property string $postal_code
 * @property string $state_or_province
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $created
 *
 * @property \EbayCheckout\Model\Entity\EbayCheckoutSession $ebay_checkout_session
 */
class EbayCheckoutSessionShippingAddress extends Entity
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
        '*' => true,
        'id' => false
    ];
}
