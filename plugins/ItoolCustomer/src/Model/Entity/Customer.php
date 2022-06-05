<?php

namespace ItoolCustomer\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * Customer Entity
 *
 * @property int $id
 * @property int $core_language_id
 * @property string $gender
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $activate_token
 * @property string $reset_token
 * @property int $reset_timeout
 * @property bool $is_active
 * @property bool $is_deleted
 * @property bool $ebay_registered
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\CoreLanguage $core_language
 * @property \EbayCheckout\Model\Entity\EbayCheckoutSession[] $ebay_checkout_sessions
 * @property \ItoolCustomer\Model\Entity\CustomerAddress[] $customer_addresses
 * @property \Feeder\Model\Entity\FeederInterestSubcategory[] $feeder_interest_subcategories
 * @property \ItoolCustomer\Model\Entity\SocialProfile[] $social_profiles
 * @property \ItoolCustomer\Model\Entity\CustomerWishlistItem[] $customer_wishlist_items
 * @property \ItoolCustomer\Model\Entity\Newsletter $newsletter
 */
class Customer extends Entity
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
        'core_language_id' => true,
        'gender' => true,
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'password' => true,
        'old_password' => true,
        'password_repeat' => true,
        'activate_token' => true,
        'reset_token' => true,
        'reset_timeout' => true,
        'is_active' => true,
        'is_deleted' => true,
        'ebay_registered' => true,
        'created' => true,
        'modified' => true,
        'core_language' => true,
        'ebay_checkout_sessions' => true,
        'customer_addresses' => true,
        'social_profiles' => true,
        'feeder_interest_subcategories' => true,
        'customer_wishlist_items' => true,
        'newsletter' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

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
