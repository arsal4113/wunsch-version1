<?php


namespace EbayCheckout\Test\GlobalTraits;

use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use App\Model\Entity\CoreUser;


trait AddCart
{
    public function testAddItem()
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $this->enableRetainFlashMessages();
        $data = [
            'qty' => 1,
            'attributes' => ["Farbe" => "Rot"],
            'itemId' => 'v1|323593478001|512609413917',
            'ebayGlobalId' => 'EBAY-DE',
            'countryCode' => 'de',
            'widgetType' => '',
            'wrapperLayout' => '',
            'variantPrice' => '7.42',
            'originalPriceValue' => '',
            'tags' => ["almost-sold-out" => "Fast ausverkauft"]
        ];
        $cart_data = $this->post('/checkout/'.$this->uuid. '/session/addItem', $data);
        return $cart_data;
    }

}
