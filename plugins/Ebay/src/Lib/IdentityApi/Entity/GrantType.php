<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 2018-12-04
 * Time: 14:13
 */

namespace Ebay\Lib\IdentityApi\Entity;


class GrantType
{
    const CLIENT_CREDENTIALS = 'client_credentials';
    const REFRESH_TOKEN = 'refresh_token';
    const AUTHORIZATION_CODE = 'authorization_code';
}