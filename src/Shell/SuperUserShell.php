<?php
namespace App\Shell;

use App\Model\Entity\CoreUser;
use Cake\Console\Shell;
use Cake\Controller\ComponentRegistry;
use Ebay\Controller\Component\EbayBuyApiComponent;

/**
 * CreateSellerAndDefaultUser shell command.
 */
class SuperUserShell extends Shell
{

    /**
     * (non-PHPdoc)
     *
     * @see \Cake\Console\Shell::initialize()
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('CoreUsers');
        $this->loadModel('Ebay.EbayAccounts');

        $component = new ComponentRegistry();

        $buy = new EbayBuyApiComponent($component);
        $this->ebayAccount = $this->EbayAccounts->find()
            ->where(['EbayAccounts.id' => $accountId])
            ->contain(['EbayCredentials', 'EbayAccountTypes', 'EbayRestApiAccessTokens'])
            ->first();
    }

    /**
     * main() method.
     *
     * @return bool|int Success or error code.
     */
    public function main()
    {
        if (empty($this->args[0]) || !in_array($this->args[0], ['make', 'remove', 'show'])) {
            return $this->error('Please enter a valid mode (make, remove).');
        }
        if (!isset($this->args[1]) && in_array($this->args[0], ['make', 'remove'])) {
            return $this->error('Please enter a valid email address.');
        }

        if ($this->args[0] == 'show') {
            $coreUsers = $this->CoreUsers->find()->where(['is_super_user' => CoreUser::SUPER_USER]);
            foreach ($coreUsers as $coreUser) {
                $this->out($coreUser->email);
            }
            return;
        }

        $coreUser = $this->CoreUsers->find()->where(['email' => $this->args[1]])->first();
        if (!$coreUser) {
            return $this->error('User not found.');
        }
        if ($this->args[0] == 'make') {
            $coreUser->is_super_user = CoreUser::SUPER_USER;
        } else {
            $coreUser->is_super_user = null;
        }
        if ($this->CoreUsers->save($coreUser)) {
            if ($this->args[0] == 'make') {
                $this->out(__('<success>{0} is awesome!</success>', $this->args[1]));
            } else {
                $this->out(__('<success>{0} is NOT awesome anymore!</success>', $this->args[1]));
            }
        }
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Cake\Console\Shell::getOptionParser()
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();
        $parser->addArgument('mode', [
            'help' => 'Make a super user with "make" or remove a super user with "remove". Use "show" to get a list of all super users',
            'required' => true
        ])->addArgument('email', [
            'help' => 'A valid email address.',
            'required' => false
        ])->description('<info>' . __('Shell to make a core user a super user.') . '</info>');
        return $parser;
    }
}
