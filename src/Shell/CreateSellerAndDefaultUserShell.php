<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Utility\Inflector;
use Cake\Core\Exception\Exception;
use Cake\Controller\ComponentRegistry;
use Acl\Controller\Component\AclComponent;

/**
 * CreateSellerAndDefaultUser shell command.
 */
class CreateSellerAndDefaultUserShell extends Shell
{

    /**
     * ACL component
     *
     * @var object
     */
    public $Acl;

    /**
     * (non-PHPdoc)
     *
     * @see \Cake\Console\Shell::initialize()
     */

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('CoreSellers');
        $this->loadModel('CoreUsers');
        $this->loadModel('CoreLanguages');
        $this->loadModel('CoreCountries');

        $component = new ComponentRegistry();
        $this->Acl = new AclComponent($component);
    }

    /**
     * main() method.
     *
     * @return bool|int Success or error code.
     */
    /*
     * checks if given name and email already exist in database
     * creates the new seller, user an d user role
     */
    public function main()
    {
        $args = [
            'name' => $this->args[0],
            'lang' => $this->args[1],
            'country' => $this->args[2],
            'email' => $this->args[3],
            'password' => $this->args[4]
        ];

        try {
            $sellerData = [
                'code' => Inflector::dasherize($args['name']),
                'name' => $args['name'],
                'is_active' => 1,
                'core_language_id' => $this->getLanguageId($args['lang']),
                'core_country_id' => $this->getCountryId($args['country'])
            ];

            if ($this->CoreUsers->find('all')->where(['email' => $args['email']])->first()) {
                throw new Exception(__("given user's e-mail already exists"));
            }
            if ($this->CoreSellers->find('all')->where(['name' => $args['name']])->first()) {
                throw new Exception(__("given seller's name already exists"));
            }
            $coreSeller = $this->CoreSellers->newEntity($sellerData);
            if ($this->CoreSellers->save($coreSeller)) {
                $coreUserRoleId = $this->CoreSellers->CoreUserRoles->createInitialSellerUserRole(
                    $coreSeller->id,
                    Inflector::camelize($coreSeller->name) . '-' . 'ADMINISTRATOR',
                    Inflector::camelize($coreSeller->name) . '-' . 'Administrator'
                );
                // Creates initial user
                $userData = [
                    'CoreUsers' => [
                        'first_name' => $coreSeller->name,
                        'last_name' => $coreSeller->name,
                        'core_seller_id' => $coreSeller->id,
                        'is_active' => 1,
                        'email' => $args['email'],
                        'password' => $args['password'],
                        'core_user_roles' => [
                            '_ids' => [$coreUserRoleId]
                        ]
                    ]
                ];
                // Сreates a new user
                $user = $this->CoreSellers->CoreUsers->createInitialSellerUser($userData);
                if (empty($user->id)) {
                    $errors = $this->getErrorList($user);
                    $coreSeller = $this->CoreSellers->get($coreSeller->id);
                    $this->CoreSellers->delete($coreSeller);
                    $coreUserRole = $this->CoreSellers->CoreUserRoles->get($coreUserRoleId);
                    $this->CoreSellers->CoreUserRoles->delete($coreUserRole);
                    $this->out('<error>' . implode(', ', $errors) . '</error>');
                    $this->out('<error>Error occured during seller & default user creation.</error>');
                } else {
                    // Allows all
                    $this->Acl->allow(
                        ['model' => 'CoreUserRoles', 'foreign_key' => $coreUserRoleId],
                        'controllers'
                    );

                    $this->out('<success>Seller & default user has been created.</success>');
                }
            } else {
                $errors = $this->getErrorList($coreSeller);
                $this->out('<error>' . implode(', ', $errors) . '</error>');
            }
        } catch (Exception $exp) {
            $this->out($exp->getMessage() . PHP_EOL);
        }
    }

    /*
     * Gets the object ($user or $coreSeller)
     * returns the list of all error messages
     */
    public function getErrorList($unit)
    {
        $errors = [];
        if ($unit->errors()) {
            foreach ($unit->errors() as $field => $errorMessages) {
                foreach ($errorMessages as $errorMessage) {
                    $errors[] = (string)$unit . 's ' . $field . ': ' . $errorMessage;
                }
            }
        }
        return $errors;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Cake\Console\Shell::getOptionParser()
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();
        $parser->addArgument('seller_name', [
            'help' => 'A valid seller name.',
            'required' => true
        ])->addArgument('language', [
            'help' => 'A valid language ISO code.',
            'required' => true
        ])->addArgument('country', [
            'help' => 'A valid country ISO code.',
            'required' => true
        ])->addArgument('email', [
            'help' => 'A valid e-mail.',
            'required' => true,
        ])->addArgument('password', [
            'help' => 'Strong password.',
            'required' => true
        ])->description('<info>' . __('Shell to create new seller & default admin user.') . '</info>');
        return $parser;
    }

    /*
     * Takes the ISO code of an existing in "core_countries" table country
     * Gives it's ID back
     */
    public function getCountryId($iso)
    {
        $country = $this->CoreCountries->find('all')->where(['iso_code' => $iso])->first();
        if (!$country) {
            throw new Exception(__("given country ISO code ' {0} ' wasn't found", $iso));
        }
        return $country->id;
    }

    /*
     * Takes the ISO code of an existing in "core_languages" table language
     * Gives it's ID back
     */
    public function getLanguageId($iso)
    {
        $language = $this->CoreLanguages->find('all')->where(['iso_code' => $iso])->first();
        if (!$language) {
            throw new Exception(__("given language ISO code ' {0} ' wasn't found", $iso));
        }
        return $language->id;
    }
}