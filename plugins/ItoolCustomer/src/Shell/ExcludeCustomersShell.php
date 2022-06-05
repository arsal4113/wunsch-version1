<?php
namespace ItoolCustomer\Shell;

use Cake\Console\Shell;
use ItoolCustomer\Model\Table\CustomersTable;
use ItoolCustomer\Model\Table\ExcludeCustomersTable;
use ItoolCustomer\Model\Table\NewslettersTable;

/**
 * ExcludeCustomers shell command.
 * @property ExcludeCustomersTable $ExcludeCustomers
 * @property NewslettersTable $Newsletters
 * @property CustomersTable $Customers
 */
class ExcludeCustomersShell extends Shell
{

    const NOT_FOUND = 'not_found';
    const NOT_FOUND_IN_NEWSLETTERS = 'not_found_in_newsletters';
    const NOT_FOUND_IN_CUSTOMERS = 'not_found_in_customers';
    const COMPLETED = 'completed';

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('ItoolCustomer.ExcludeCustomers');
        $this->loadModel('ItoolCustomer.Newsletters');
        $this->loadModel('ItoolCustomer.Customers');
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        $excludeCustomers = $this->ExcludeCustomers->find()->where(['is_deleted' => 0]);

        foreach ($excludeCustomers as $excludeCustomer)
        {
            $foundInNewsletters = false;
            $foundInCustomers = false;
            $newsletter = $this->Newsletters->find()->where(['email' => $excludeCustomer->email])->first();
            if (!empty($newsletter)) {
                $foundInNewsletters = true;
                $this->Newsletters->delete($newsletter);
            }

            $customer = $this->Customers->find()->where(['email' => $excludeCustomer->email])->first();
            if (!empty($customer)) {
                $foundInCustomers = true;
                $customer->is_deleted = 1;
                $this->Customers->save($customer);
            }

            if ($foundInCustomers && $foundInNewsletters) {
                $excludeCustomer->is_deleted = 1;
                $excludeCustomer->status = self::COMPLETED;
            } else if (!$foundInCustomers && !$foundInNewsletters) {
                $excludeCustomer->status = self::NOT_FOUND;
            } else if (!$foundInCustomers || $foundInNewsletters) {
                $excludeCustomer->status = (!$foundInCustomers) ? self::NOT_FOUND_IN_CUSTOMERS : self::NOT_FOUND_IN_NEWSLETTERS;
            }

            $this->ExcludeCustomers->save($excludeCustomer);
        }
    }
}
