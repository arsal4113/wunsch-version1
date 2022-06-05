<?php

namespace UrlRewrite\Model\Entity;

use Cake\ORM\Entity;

/**
 * UrlRewriteRedirectType Entity.
 *
 * @property int $id
 * @property int $code
 * @property string $name
 * @property string $header
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class UrlRewriteRedirectType extends Entity
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
        'code' => true,
        'name' => true,
        'header' => true,
        'created' => true,
        'modified' => true,
        'url_rewrite_redirects' => true,
    ];

    /**
     * Create Header
     *
     * @param string $code
     * @return string $code
     */
    protected function _setCode($code)
    {
        $this->header = __('HTTP/1.1 {0} {1}', [$this->code, $this->name]);
        return $code;
    }
}
