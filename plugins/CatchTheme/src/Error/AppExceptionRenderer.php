<?php
namespace CatchTheme\Error;

use Cake\Error\ExceptionRenderer;
use CatchTheme\Controller\ErrorController;

class AppExceptionRenderer extends ExceptionRenderer
{
    protected function _getController()
    {
        return new ErrorController();
    }
}
