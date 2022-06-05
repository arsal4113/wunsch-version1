<?php

namespace App\Event;

use Cake\Event\EventListenerInterface;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Routing\Router;

class CoreSellerRegistrationListener implements EventListenerInterface
{
    public function implementedEvents()
    {
        return [
            'Controller.CoreSellers.afterRegistration' => [
                'callable' => 'sendConfirmationMail',
                'priority' => 100
            ],
            'Controller.CoreSellers.resentConfirmationMail' => [
                'callable' => 'sendConfirmationMail',
                'priority' => 100
            ]
        ];
    }

    public function sendConfirmationMail(Event $event)
    {
        if (!empty($event->getData('coreSeller'))) {
            $coreSeller = TableRegistry::get('CoreSellers')->find()
                ->where(['CoreSellers.id' => $event->getData('coreSeller')->id])
                ->contain(['CoreUsers', 'CoreSellerTypes'])
                ->first();

            if (isset($coreSeller->core_users[0]->email) && !empty($coreSeller->core_users[0]->email)) {
                $recipientEmail = $coreSeller->core_users[0]->email;
                $email = new Email();
                $activationUrl = Router::fullBaseUrl() . Router::url(['controller' => 'CoreSellers', 'action' => 'activateAccount/' . $coreSeller->activation_token . '/' . $recipientEmail]);
                $email->setViewVars(['coreSeller' => $coreSeller, 'activationUrl' => $activationUrl]);
                $email->setHelpers(['Html']);
                $email->setTemplate('seller_type_' . $coreSeller->core_seller_type->code . '_registration');
                $email->setTo($recipientEmail);
                $email->setSubject(__('Welcome to i-ways eBay Template Creator'));
                $email->setEmailFormat('html');
                $email->send();
            }
        }
    }
}