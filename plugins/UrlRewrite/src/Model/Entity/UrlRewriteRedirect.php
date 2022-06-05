<?php

namespace UrlRewrite\Model\Entity;

use Cake\ORM\Entity;

/**
 * UrlRewriteRedirect Entity.
 *
 * @property int $id
 * @property int $url_rewrite_redirect_type_id
 * @property string $source_url
 * @property string $target_url
 * @property string $creator
 * @property int $timestamp
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class UrlRewriteRedirect extends Entity
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
        'url_rewrite_redirect_type_id' => true,
        'source_url' => true,
        'target_url' => true,
        'creator' => true,
        'timestamp' => true,
        'created' => true,
        'modified' => true,
        'url_rewrite_type' => true,
    ];
}
