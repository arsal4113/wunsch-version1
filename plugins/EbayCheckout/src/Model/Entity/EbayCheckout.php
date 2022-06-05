<?php
namespace EbayCheckout\Model\Entity;

use Cake\ORM\Entity;

/**
 * EbayCheckout Entity
 *
 * @property int $id
 * @property int $core_seller_id
 * @property string $name
 * @property string $title
 * @property string $x_frame_origins
 * @property string $logo
 * @property string $main_color
 * @property string $second_color
 * @property string $font
 * @property string $font_color
 * @property string $background_image
 * @property string $background_image_position
 * @property string $background_color
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $created
 *
 * @property \EbayCheckout\Model\Entity\CoreSeller $core_seller
 * @property \EbayCheckout\Model\Entity\EbayCheckoutSession[] $ebay_checkout_sessions
 */
class EbayCheckout extends Entity
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
