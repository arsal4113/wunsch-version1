<?php
/**
 * Created by PhpStorm.
 * User: VD
 * Date: 2018-12-07
 * Time: 15:16
 */

namespace App\Event;

use Cake\Event\Event;
use Cake\Event\EventListenerInterface;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;

/**
 * Class EbayAuthEventListener
 * @package App\Event
 */
class EbayAuthEventListener implements EventListenerInterface
{
    /**
     * @return array
     */
    public function implementedEvents()
    {
        return [
            'Ebay.Controller.EbayAuthLandingPages.declined' => [
                'callable' => 'declined',
                'priority' => 100
            ],
            'Ebay.Controller.EbayAuthLandingPages.failedFetchToken' => [
                'callable' => 'failedFetchToken',
                'priority' => 100
            ],
            'Ebay.Controller.EbayAuthLandingPages.userLoggedIn' => [
                'callable' => 'userLoggedIn',
                'priority' => 100
            ]
        ];
    }

    /**
     * @param Event $event
     * @throws \Exception
     */
    public function userLoggedIn(Event $event)
    {
        $ebayUser = $event->getData('ebayUser');

        if (!empty($ebayUser)) {
            $email = $ebayUser->individualAccount->email ?? null;
            if (empty($email)) {
                $email = $ebayUser->businessAccount->email ?? null;
            }

            if (empty($email)) {
                throw new \Exception(__('Invalid ebay user data.'));
            }

            $customers = TableRegistry::getTableLocator()->get('ItoolCustomer.Customers');
            $customer = $customers->find()->where(['email' => $email])->first();

            if (!empty($customer) && !$customer->ebay_registered) {
                $customer->ebay_registered = 1;
                $customers->save($customer);
            }

            if (empty($customer)) {
                $language = TableRegistry::getTableLocator()->get('CoreLanguages')->find()->where(['iso_code' => 'de'])->first();

                $accountType = $ebayUser->accountType ?? null;
                $firstName = '';
                $lastName = '';
                $address = [];

                switch (strtoupper($accountType)) {
                    case 'INDIVIDUAL' :
                        $firstName = $ebayUser->individualAccount->firstName ?? '';
                        $lastName = $ebayUser->individualAccount->lastName ?? '';
                        $countryCode = $ebayUser->individualAccount->registrationAddress->country ?? '';
                        $addressLine1 = $ebayUser->individualAccount->registrationAddress->addressLine1 ?? '';
                        $addressLine2 = $ebayUser->individualAccount->registrationAddress->addressLine2 ?? '';
                        $city = $ebayUser->individualAccount->registrationAddress->city ?? '';
                        $postalCode = $ebayUser->individualAccount->registrationAddress->postalCode ?? '';
                        $phoneNumber = $ebayUser->individualAccount->primaryPhone->number ?? '';

                        if (!empty($countryCode)) {
                            $coreCountry = TableRegistry::getTableLocator()->get('CoreCountries')->find()
                                ->where(['iso_code_3166_2' => $countryCode])
                                ->first();
                            if (!empty($coreCountry)) {
                                $shippingAddressType = TableRegistry::getTableLocator()->get('ItoolCustomer.CustomerAddressTypes')->find()
                                    ->where(['code' => 'shipping'])
                                    ->first();

                                $address = [
                                    'core_country_id' => $coreCountry->id,
                                    'first_name' => $firstName,
                                    'last_name' => $lastName,
                                    'street_line_1' => $addressLine1,
                                    'street_line_2' => $addressLine2,
                                    'city' => $city,
                                    'state' => '',
                                    'postal_code' => $postalCode,
                                    'phone_number' => $phoneNumber,
                                    'customer_address_types' => [
                                        '_ids' => [$shippingAddressType->id]
                                    ]
                                ];
                            }
                        }
                        break;
                    case 'BUSINESS' :
                        $firstName = $ebayUser->businessAccount->primaryContact->firstName ?? '';
                        $lastName = $ebayUser->businessAccount->primaryContact->lastName ?? '';

                        $countryCode = $ebayUser->businessAccount->address->country ?? '';
                        $addressLine1 = $ebayUser->businessAccount->address->addressLine1 ?? '';
                        $addressLine2 = $ebayUser->businessAccount->address->addressLine2 ?? '';
                        $city = $ebayUser->businessAccount->address->city ?? '';
                        $postalCode = $ebayUser->businessAccount->address->postalCode ?? '';
                        $phoneNumber = $ebayUser->businessAccount->primaryPhone->number ?? '';

                        if (!empty($countryCode)) {
                            $coreCountry = TableRegistry::getTableLocator()->get('CoreCountries')->find()
                                ->where(['iso_code_3166_2' => $countryCode])
                                ->first();
                            if (!empty($coreCountry)) {
                                $shippingAddressType = TableRegistry::getTableLocator()->get('ItoolCustomer.CustomerAddressTypes')->find()
                                    ->where(['code' => 'shipping'])
                                    ->first();

                                $address = [
                                    'core_country_id' => $coreCountry->id,
                                    'first_name' => $firstName,
                                    'last_name' => $lastName,
                                    'street_line_1' => $addressLine1,
                                    'street_line_2' => $addressLine2,
                                    'city' => $city,
                                    'state' => '',
                                    'postal_code' => $postalCode,
                                    'phone_number' => $phoneNumber,
                                    'customer_address_types' => [
                                        '_ids' => [$shippingAddressType->id]
                                    ]
                                ];
                            }
                        }
                        break;
                }

                $defaultPass = bin2hex(Security::randomBytes(16));

                $customerData = [
                    'is_active' => 1,
                    'is_deleted' => 0,
                    'email' => $email,
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'password' => $defaultPass,
                    'password_repeat' => $defaultPass,
                    'core_language_id' => $language->id,
                    'ebay_registered' => 1
                ];

                if (!empty($address)) {
                    $customerData['customer_addresses'] = [$address];
                }

                $customer = $customers->newEntity($customerData, [
                    'associated' => ['CustomerAddresses.CustomerAddressTypes']
                ]);
                $customers->save($customer);
            }
            $event->setResult([
                'user' => $customer,
                'redirect' => ['plugin' => 'ItoolCustomer', 'controller' => 'Account', 'action' => 'edit'],
            ]);
        }
    }

    /**
     * @param Event $event
     */
    public function declined(Event $event)
    {
        $event->setResult(['redirect' => '/']);
    }

    /**
     * @param Event $event
     */
    public function failedFetchToken(Event $event)
    {
        $event->setResult(['redirect' => '/']);
    }
}
