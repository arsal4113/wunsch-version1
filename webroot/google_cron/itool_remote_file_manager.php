<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 2019-08-30
 * Time: 13:31
 */

if (!empty($_GET['securitas']) && $_GET['securitas'] == 'v3rys3cUre') {
    echo exec('../../bin/cake RemoteFileManagerProcessor');
}
