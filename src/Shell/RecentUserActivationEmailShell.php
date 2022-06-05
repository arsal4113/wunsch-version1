<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\I18n\I18n;
use Cake\Routing\Router;
use Cake\Mailer\Email;

/**
 * RecentUserActivationEmail shell command.
 */
class RecentUserActivationEmailShell extends Shell
{

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();
        $parser->addArgument('languageCode', [
            'help' => 'A valid language code as ISO format.',
            'required' => false
        ])->description('<info>' . __('Shell to resend activation email.') . '</info>');

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        $this->loadModel('CoreSellers');
        $limit = 25;
        $page = 1;
        do {
            $coreSellers = $this->CoreSellers->find()
                ->where([
                    'CoreSellers.is_active' => 0,
                    'CoreLanguages.iso_code' => $this->args[0],
                    'CoreSellers.created >' => '2016-11-29'
                ])
                ->contain(['CoreLanguages'])
                ->limit($limit)
                ->page($page++);

            if (!empty($coreSellers->toArray())) {
                foreach ($coreSellers as $coreSeller) {
                    I18n::locale($coreSeller->core_language->iso_code);
                    $this->sendConfirmationMail($coreSeller->id);
                }
            }
        } while (!empty($coreSellers->toArray()));
    }


    public function sendConfirmationMail($coreSellerId)
    {
        $coreSeller = $this->CoreSellers->find()
            ->where(['CoreSellers.id' => $coreSellerId])
            ->contain(['CoreUsers', 'CoreSellerTypes'])
            ->first();

        if (isset($coreSeller->core_users[0]->email) && !empty($coreSeller->core_users[0]->email)) {
            try {
                $recipientEmail = $coreSeller->core_users[0]->email;
                echo "Email: " . $recipientEmail . "\n";

                $email = new Email();
                $activationUrl = 'https://templates.i-ways.net/core_sellers/activateAccount/' . $coreSeller->activation_token . '/' . $recipientEmail;
                $email->viewVars(['coreSeller' => $coreSeller, 'activationUrl' => $activationUrl]);
                $email->helpers(['Html']);
                $email->template('seller_type_' . $coreSeller->core_seller_type->code . '_resend_registration');
                $email->to($recipientEmail);
                $email->subject(__('Welcome to i-ways eBay Template Creator'));
                $email->emailFormat('html');
                $email->send();
                echo "Result: ok \n\n";
            }catch(\Exception $exp) {
                echo "Result: " . $exp->getMessage() . "\n\n";
            }
        }
    }
}
