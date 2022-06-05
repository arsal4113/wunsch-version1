<?php
namespace ItoolCustomer\Shell;

use Cake\Console\Shell;
use Cake\Controller\ComponentRegistry;
use ItoolCustomer\Controller\Component\EmailComponent;
use ItoolCustomer\Model\Entity\Newsletter;
use ItoolCustomer\Model\Table\NewslettersTable;

/**
 * ValidateNewsletterEmail shell command.
 * @property NewslettersTable Newsletters
 */
class ValidateNewsletterEmailShell extends Shell
{
    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        $this->loadModel('ItoolCustomers.Newsletters');
        /** @var EmailComponent $Email */
        $Email = new EmailComponent(new ComponentRegistry());

        $newsletters = $this->Newsletters->find()->where(['validation_score IS' => null])
            ->limit(5000)->all();

        foreach ($newsletters as $newsletter) {
            /** @var Newsletter $newsletter */
            $newsletter->validation_score = $Email->validateWithSendgrid($newsletter->email);
        }
        $this->Newsletters->saveMany($newsletters);
        $this->out(__('{0} email addresses checked', count($newsletters->toArray())));
    }
}
