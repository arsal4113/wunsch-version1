<?php
namespace ItoolCustomer\Model\Entity;

use Cake\ORM\Entity;

/**
 * SocialProfile Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $provider
 * @property string|resource $access_token
 * @property string $identifier
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $full_name
 * @property string $email
 * @property string $birth_date
 * @property string $gender
 * @property string $picture_url
 * @property bool $email_verified
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \ItoolCustomer\Model\Entity\User $user
 */
class SocialProfile extends Entity
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
        'user_id' => true,
        'provider' => true,
        'access_token' => true,
        'identifier' => true,
        'username' => true,
        'first_name' => true,
        'last_name' => true,
        'full_name' => true,
        'email' => true,
        'birth_date' => true,
        'gender' => true,
        'picture_url' => true,
        'email_verified' => true,
        'created' => true,
        'modified' => true,
        'user' => true
    ];
}
