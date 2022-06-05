<?php

namespace UrlRewrite\Model\Entity;

use Cake\ORM\Entity;

/**
 * UrlRewriteRoute Entity.
 *
 * @property int $id
 * @property string $target_url
 * @property string $plugin
 * @property string $controller
 * @property string $action
 * @property string $args
 * @property string $creator
 * @property int $timestamp
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class UrlRewriteRoute extends Entity
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
        'target_url' => true,
        'plugin' => true,
        'controller' => true,
        'action' => true,
        'args' => true,
        'creator' => true,
        'timestamp' => true,
        'created' => true,
        'modified' => true,
    ];
}
