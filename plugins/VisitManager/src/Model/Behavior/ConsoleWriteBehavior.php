<?php

namespace VisitManager\Model\Behavior;

use Cake\ORM\Behavior;

/**
 * Class ConsoleWriteBehavior
 * @package VisitManager\Model\Behavior
 */
class ConsoleWriteBehavior extends Behavior
{
    /**
     * @param $toWrite
     */
    public function writeToConsole($toWrite)
    {
        echo "<script>console.log( '" . $toWrite . "' );</script>";
    }
}
