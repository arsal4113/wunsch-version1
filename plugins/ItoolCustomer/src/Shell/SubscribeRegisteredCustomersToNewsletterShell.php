<?php
namespace ItoolCustomer\Shell;

use Cake\Console\Shell;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\Query;
use ItoolCustomer\Controller\Component\NewsletterHelperComponent;
use ItoolCustomer\Model\Entity\Customer;
use ItoolCustomer\Model\Table\CustomersTable;

/**
 * SubscribeRegisteredCustomersToNewsletter shell command.
 *
 * @property CustomersTable $Customers
 */
class SubscribeRegisteredCustomersToNewsletterShell extends Shell
{
    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        ini_set('max_execution_time', 0);
        $this->loadModel('ItoolCustomer.Customers');

        $customers = $this->Customers->find()
            ->where([
                'is_active' => 1,
                'is_deleted' => 0,
                'ebay_registered' => 0
            ])
            ->notMatching('SocialProfiles',  function (Query $q) {
                return $q;
            })
            ->notMatching('Newsletters',  function (Query $q) {
                return $q;
            })
            ->orderDesc('Customers.id');

        $this->out(__('Subscribe {0} registered customers to newsletter.', $customers->count()));

        /** @var NewsletterHelperComponent $NewsletterHelper */
        $NewsletterHelper = new NewsletterHelperComponent(new ComponentRegistry());

        foreach ($customers as $customer) {
            /** @var Customer $customer */
            $NewsletterHelper->subscribeToNewsletter(false, $customer->email);
        }
    }
}
