<?php

namespace VisitManager\Model\Behavior;

use Cake\Network\Session;
use Cake\ORM\Behavior;
use Cake\Routing\Router;

/**
 * Class SessionBehavior
 * @package VisitManager\Model\Behavior
 */
class SessionBehavior extends Behavior
{
    /**
     * @param $name
     * @param $session
     * @return bool
     */
    public function isSessionSet($name, $session)
    {
        if (empty($session) && !($session instanceof Session)) {
            $session = new Session();
        }
        if ($this->getSessionValue($name, $session)) {
            return true;
        }
        return false;
    }

    /**
     * @param $name
     * @param $session
     * @return mixed
     */
    public function getSessionValue($name, $session)
    {
        return $session->read($name);
    }

    /**
     * sessionStart
     */
    public function sessionStart()
    {
        $session = new Session();
        if (!(session_status() === \PHP_SESSION_ACTIVE)) {
            $session->start();
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    public function processSession($name)
    {
        $request = Router::getRequest();
        $session = new Session();
        $sessionExist = $this->isSessionSet($name, $session);
        if (!$sessionExist) {
            $this->sessionStart();
            $session->write($name, $request->getSession()->id());
        }
        return $this->getSessionValue($name, $session);
    }
}
