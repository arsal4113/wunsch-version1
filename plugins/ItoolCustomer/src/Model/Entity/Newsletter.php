<?php
namespace ItoolCustomer\Model\Entity;

use Cake\ORM\Entity;

/**
 * Newsletter Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property string $email
 * @property bool $subscribed
 * @property string $subscribe_type
 * @property string $registration_source
 * @property float $validation_score
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Newsletter extends Entity
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
        'email' => true,
        'subscribed' => true,
        'subscribe_type' => true,
        'created' => true,
        'modified' => true,
        'registration_source' => true,
        'validation_score' => true,
    ];
}
