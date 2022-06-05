<?php

namespace ItoolCustomer\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Http\Client;
use Cake\ORM\TableRegistry;
use ItoolCustomer\Model\Table\NewslettersTable;

/**
 * Class NewsletterHelperComponent
 *
 * @property EmailComponent $Email
 * @property NewslettersTable $Newsletters
 */
class NewsletterHelperComponent extends Component
{
    public $components = ['ItoolCustomer.Email'];

    /**
     * @param null $mail
     * @return array
     */
    public function sendSignUpEmail($mail = null)
    {
        $email = $mail ?: $this->getController()->request->getData('email');
        $isSubscribed = $this->checkIfSubscribed($email);

        if (!$isSubscribed) {
            $this->Email->send($email, __d('itool_customer', __('Catch Newsletter angemeldet.')), 'ItoolCustomer.optin_confirmed', [
                'email' => $email
            ]);
            $response = $this->subscribeToNewsletter($this->getController()->request, $email);
        }
        $isValidEmail = $response['success'] ?? true;
        return ['success' => !$isSubscribed && $isValidEmail, 'isSubscribed' => $isSubscribed, 'isValidEmail' => $isValidEmail];
    }

    /**
     * @param $request
     * @param $email
     * @return array
     */
    public function subscribeToNewsletter($request, $email = false)
    {
        $response = ['success' => false];

        if (empty($email) && !empty($request)) {
            $email = $this->getController()->request->getData('email');
            $type = $this->getController()->request->getData('type');
        }

        if (empty($email)) {
            return $response;
        }

        $this->Newsletters = TableRegistry::getTableLocator()->get('ItoolCustomer.Newsletters');
        $customer = $this->Newsletters->Customers->find()->where(['email' => $email])->first();

        $newsletter = $this->getNewsletterForEmail($email);
        if (!$newsletter) {
            $newsletter = $this->Newsletters->newEntity();
            $newsletter->email = $email;
            $score = $this->Email->validateWithSendgrid($email);
            $newsletter->validation_score = $score ?: null;
        }
        $newsletter->subscribed = 1;
        $newsletter->subscribe_type = $type ?? $this->getDefaultSubscriptionType();
        $newsletter->customer_id = $customer->id ?? null;

        $isValidEmail = isset($score) ? $score > 0.5 : true;

        if ($registrationSource = $request->getData('source')) {
            $newsletter->registration_source = $registrationSource;
        }

        if ($this->Newsletters->save($newsletter)) {
            $response = ['success' => $isValidEmail];
        } else {
            $response = ['success' => false, 'errors' => $newsletter->getErrors()];
        }
        return $response;
    }

    /**
     * @param $email
     * @return bool
     */
    public function checkIfSubscribed($email)
    {
        $user = $this->getNewsletterForEmail($email);
        return (isset($user) && $user->subscribed);
    }

    /**
     * @param $email
     * @return array|\Cake\Datasource\EntityInterface|null
     */
    public function getNewsletterForEmail($email)
    {
        $this->Newsletters = TableRegistry::getTableLocator()->get('ItoolCustomer.Newsletters');
        return $this->Newsletters->find()->where(['email' => $email])->first();
    }

    /**
     * @return mixed
     */
    public function getDefaultSubscriptionType()
    {
        return Configure::read('dealsguru.newsletter.default_subscription_type', NewslettersTable::WEEKLY);
    }

    public function addToSendgridContacts($email, $name = 'contactName')
    {
        $apiKey = Configure::read('Sendgrid.apiKey');

        $client = new Client();
        $response = $client->put('https://api.sendgrid.com/v3/marketing/contacts',
            json_encode([
                'contacts' => [
                    (object) ['email' => $email]
                ]
            ]),
            [ 'headers' => [ 'Authorization' => 'Bearer ' . $apiKey],
                'type' => 'json'
            ]
        );
    }

    public function deleteFromSendgridContacts($email)
    {
        $apiKey = Configure::read('Sendgrid.apiKey');

        $client = new Client();

        $response = $client->post('https://api.sendgrid.com/v3/marketing/contacts/search',
            json_encode([
                'query' => 'email LIKE \'' . $email . '\''
            ]),
            [ 'headers' => [ 'Authorization' => 'Bearer ' . $apiKey],
                'type' => 'json'
            ]
        );

        $id = json_decode($response->getStringBody())->result[0]->id ?? null;

        if (empty($id)) {
            return;
        }

        $response = $client->delete('https://api.sendgrid.com/v3/marketing/contacts?ids=' . $id,
            [],
            [ 'headers' => [ 'Authorization' => 'Bearer ' . $apiKey],
              'type' => 'json'
            ]
        );
    }
}
