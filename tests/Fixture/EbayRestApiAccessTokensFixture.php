<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EbayRestApiAccessTokensFixture
 */
class EbayRestApiAccessTokensFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $connection = 'test';
    public $import = [
        'model' => 'EbayRestApiAccessTokens',
        'connection' => 'default'
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'ebay_account_id' => 1,
                'user_identifier' => 1,
                'token' => 'v^1.1#i^1#r^0#I^3#f^0#p^1#t^H4sIAAAAAAAAAOVYXWwUVRTutNsK1ooGUkslZB1+DNTZ+e12Z+guLt1Cl5+2sttSGrHenbmzDDs7s5k703YJD0tjCIjIgyTVgKSJSBBDsBINIcaERB5QIICJiYkmxAdoMEQSgkoixJndpWwraZFusIn7splzzz33O993zr13hspUzFy6o2XHH1XYU6VDGSpTimF0JTWzorzu2bLS2vISqsABG8oszLgGykYaEUiqKWE9RCldQ9Ddn1Q1JGSNftwyNEEHSEGCBpIQCaYoRILr1gqMhxJShm7qoq7i7nDIj3NsA4AcBWia5iDf0GBbtfsxo7ofZ+sZjvXxgAU+3sfToj2OkAXDGjKBZvpxhmIoguIJiovSrMCxAs17aJ+vG3d3QgMpuma7eCg8kIUrZOcaBVgnhgoQgoZpB8ED4eDKSFswHGpujTaSBbECeR4iJjAtNPapSZeguxOoFpx4GZT1FiKWKEKEcDKQW2FsUCF4H8xjwM9SHWMg76Uomuc4ryTydFGoXKkbSWBOjMOxKBIhZ10FqJmKmZ6MUZuN2BYomvmnVjtEOOR2/l6zgKrICjT8ePOK4MZgezseUPpAGiGgEiEIVLTKMoj29SECyjTgaYbnCejlGUBJXH6hXLQ8zeNWatI1SXFIQ+5W3VwBbdRwPDdsATe2U5vWZgRl00FU6Fc/yqG32xE1p6JlbtYcXWHSJsKdfZxcgdHZpmkoMcuEoxHGD2Qp8uMglVIkfPxgthbz5dOP/Phm00wJJNnX1+fpYz26EScZuz7IrnVrI+JmmAS47ev0es5fmXwCoWRTEaE9EymCmU7ZWPrtWrUBaHE8wDRwDO3L8z4WVmC89R+GgpzJsR1RrA6BlBfKHN8ggxgj0rGibDaBfJGSDg4YA2kiCYwENFMqECEh2nVmJaGhSAJbLzOsT4aE5OVlguNlmYjVS16CliGkIIzFRN73f2qURy31CBQNaBal1otW596NdYl+C62Qm3tZqrtpTVeiQ9+KqFibT5aNIBmyetfEpa0tjE2n/1G74eHJi3oKtuuqIqaLwIDT60VkgTWkdmCY6QhUVdswpUSRk+j0EtmZj+wAIKV4nMb2iHqS1IG9ozumniziKeUcTKXCyaRlgpgKw8XZzf+jnfyh6Sn2XWda5WTrlxNSkXKXFE9WTQ/qFT0GRLpl2PczT5tzZkf1BNTsHdA0dFWFRic9ZaGftL5Or0/Cx788LB4v9+LdVKZTbYuqYpdQz3TL7IkoqoBpdhrT9TzPMF6e56eUV1NW02h6up1DLToyoTRRaq5Vj3mtJse+5AdKsj96APuCGsCGSzGMIqlF9ALqpYqyDlfZM7VIMaFHAbIHKXHNfnc1oCcB0ymgGKUVWKoDXF9U8FlhaBNVM/phYWYZXVnwlYGa92CknJ71QpVNCU9xNMuxNN9NLXgw6qKrXXNm7Np2oObWzY6erpZvhe3XsP3LLmeoqlEnDCsvcQ1gJdxssjOd/On2O40jyw++/MbhyrN1O48vcy/ZdDk+46o+/1Rt9ZGzw+yWvhsfadK6i/sO1ny9a23D6nvn3Ut+WLx+w5HrX87vjVzd+9c3++KSXvUptu3V39rK3657rv/PY4nt185h945F4xsWB2+cstxXKwe//+4KeXH7uSXz1pzff+l3nTiJ1R6ec3fWnV8/232n983Th7s+vvveXG8j/+EH5GBT6JPnhzK71eSWkePxua3XX1/Y1Ty4qLru5uoLt0vae+J3D73SpzRV703eGR7c8/OFF0vK/HMDGw4sPUMOHz20U655+sRXrn2fY80nostHTp778dbgu/PeOn908Znw+1cunU7smI0OLJ9v7f4lJ9/fDLsFuvARAAA=',
                'expire_timestamp' => 1,
                'token_expire_timestamp' => null,
                'refresh_token' => null,
                'refresh_token_expire_timestamp' => null,
                'grant_type' => 'client_credentials',
                'token_type' => 'application_token',
                'scope' => 'https://api.ebay.com/oauth/api_scope',
                'created' => '2020-12-10 18:53:27',
                'modified' => '2020-12-10 18:53:27',

            ],
        ];
        parent::init();
    }
}
