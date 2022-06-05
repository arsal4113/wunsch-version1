<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CoreErrorNotificationProfile Entity.
 *
 * @property int $id
 * @property int $core_seller_id
 * @property \App\Model\Entity\CoreSeller $core_seller
 * @property string $name
 * @property string $type
 * @property string $code
 * @property string $sub_code
 * @property string $email_to
 * @property string $email_cc
 * @property string $email_bcc
 * @property string $email_subject
 * @property bool $is_active
 * @property bool $is_running
 * @property \Cake\I18n\Time $last_run
 * @property int $run_interval
 * @property \Cake\I18n\Time $next_run
 * @property int $max_execution_time
 * @property \Cake\I18n\Time $last_alive
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class CoreErrorNotificationProfile extends Entity
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
        'id' => false,
    ];
}
