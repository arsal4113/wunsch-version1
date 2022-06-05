<?php
namespace ItoolCustomer\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\Http\Client;

/**
 * Email component
 */
class EmailComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function send($to, $subject, $template, $vars)
    {
        $email = new Email('default');
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setTemplate($template);
        $email->setEmailFormat('both');
        $email->setViewVars($vars);
        return $email->send();
    }

    /**
     * @param $email
     * @return null|float
     */
    public function validateWithSendgrid($email)
    {
        $apiKey = Configure::read('Sendgrid.emailValidation.apiKey');
        if (empty($apiKey)) {
            return null;
        }
        $client = new Client();
        $response = $client->post(
            'https://api.sendgrid.com/v3/validations/email',
            json_encode([ 'email' => $email]),
            [ 'headers' => [ 'Authorization' => 'Bearer ' . $apiKey],
              'type' => 'json'
            ]
        );
        $result = json_decode($response->getStringBody())->result;
        $verdict = $result->verdict;
        $score = $result->score;
        return $score;
    }
}
