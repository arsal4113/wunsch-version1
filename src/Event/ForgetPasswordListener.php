<?php

namespace App\Event;

use Cake\Event\EventListenerInterface;
use Cake\Event\Event;
use Cake\Mailer\Email;

class ForgetPasswordListener implements EventListenerInterface
{
    public function implementedEvents()
    {
        return [
            'Controller.CoreUsers.forgotPassword' => 'forgotPassword',
            'Controller.CoreUsers.resetPassword' => 'resetPassword'
        ];
    }

    public function forgotPassword(Event $event)
    {
        if (!empty($event->getData('user'))) {
            $user = $event->getData('user');
            $resetPasswordLink = $event->getData('resetPasswordLink');
            $email = new Email();
            $email->setTo($user->email);
            $email->setSubject(__('Forgot Password Request'));
            $email->setEmailFormat('html');
            $email->setTemplate('forgot_password');
            $email->setViewVars(compact(['user', 'resetPasswordLink']));
            $email->send();
        }
    }


    public function resetPassword(Event $event)
    {
        if (!empty($event->getData('user'))) {
            $user = $event->getData('user');
            $email = new Email();
            $email->setTo($user->email);
            $email->setSubject(__('Reset Password'));
            $email->setEmailFormat('html');
            $email->setTemplate('reset_password');
            $email->setViewVars(compact(['user']));
            $email->send();
        }
    }
}