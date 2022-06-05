<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 12.11.18
 * Time: 15:53
 */

if (!empty($_GET['securitas']) && $_GET['securitas'] == 'v3rys3cUre') {
    echo exec('../../bin/cake CheckHeroItemsOutOfStock');
}
