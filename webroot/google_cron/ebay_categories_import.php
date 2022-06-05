<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 2019-09-05
 * Time: 10:59
 */

if (!empty($_GET['securitas']) && $_GET['securitas'] == 'v3rys3cUre') {
    echo exec('../../bin/cake downloader downloadCategories 77');
}
