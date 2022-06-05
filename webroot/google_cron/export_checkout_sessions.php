<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 2018-11-29
 * Time: 13:58
 */

if (!empty($_GET['securitas']) && $_GET['securitas'] == 'v3rys3cUre') {
    echo exec('../../bin/cake upload_checkout_sessions');
}
