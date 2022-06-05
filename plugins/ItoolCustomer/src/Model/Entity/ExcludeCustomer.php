<?php
namespace ItoolCustomer\Model\Entity;

use Cake\ORM\Entity;

/**
 * ExcludeCustomer Entity.
 *
 * @property int $id
 * @property string $email
 * @property bool $is_deleted
 * @property int $uploaded_user_identifier
 * @property string $status
 * @property \Cake\I18n\Time|null $created
 * @property \Cake\I18n\Time|null $modified
 */
class ExcludeCustomer extends Entity
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
        'email' => true,
        'is_deleted' => true,
        'uploaded_user_identifier' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
    ];
}
