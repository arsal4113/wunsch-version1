<?php
namespace EbayCheckout\Test\Fixture;

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
                'id' => '1369',
                'ebay_account_id' => '1',
                'user_identifier' => NULL,
                'token' => 'v^1.1#i^1#r^0#p^1#I^3#f^0#t^H4sIAAAAAAAAAOVYe2wURRjvXR+khaIGREQMZQEThd3bx+12d2kvHpTHEaAnrQUKps7tzrXb7u1uduY4ToM01SAkIkgMhIiBBBIiEIISAiFaQIMJFgmSAiH4iBojf2B8QDQYIs5eH1wLAaRHaOJlk8vMfPPN9/v9vm9mdtnWouLnVs1e9Vepb4h/Wyvb6vf5uKFscVHh5OH5/jGFeWyWgW9b68TWgrb8SxUIJExHXQCRY1sIli1PmBZSM52VVNK1VBsgA6kWSECkYk2tCc+bq/IMqzqujW3NNqmySFUlJQFN4oMKJ8msKEBNIL1Wj89am4wL5ZoIyyUoxnlNF3gyjlASRiyEgYUrKZ7lFJolj1jLCSovqkGZkTihniqrgy4ybIuYMCwVyoSrZua6WbHeOVSAEHQxcUKFIuGZNdXhSNWM+bUVgSxfoW4eajDASdS3Nd3WYVkdMJPwzsugjLVak9Q0iBAVCHWt0NepGu4J5j7Cz1Adk3kANFbSZL68PKYFc0LlTNtNAHznOLweQ6fjGVMVWtjA6bsxStiINUMNd7fmExeRqjLv74UkMI24Ad1Kasa08OJwNEqFjBRIIwRMugoCE81KunR0QRUtx2Ospki8TotCXBFEQeleqMtbN839VppuW7rhkYbK5tt4GiRRw/7ccFncEKNqq9oNx7EXUbad2MMhK9d7onapmMRNlqcrTBAiyjLNuyvQOxtj14glMez10H8gQ1ElBRzH0Kn+g5lc7E6f5aiSasLYUQOBVCrFpATGdhsDPMtygUXz5tZoTTABKGLr1XqXvXH3CbSRgaJBMhMZKk47JJblJFdJAFYjFeJlVpH5bt77hhXq33tLRxbmQN+KyFWFAFmUFUWBXJAToahJuaiQUHeSBrw4YAyk6QRwWyB2TKBBWiN5lkxA19BVgexwghyHtC4pcTqoxON0TNQlmotDyEIYi2mK/H8qlHtN9RrNdmDUNg0tnZOEz1myC64eBS5OR12YICpMc4GlQ32hgZsiVdF7rYHbQkYe5AcA1qv1AQD2fCCyInAMxst0RrMTARuQLc7rashEHYgl00xjEiJMFtChOyAewo4TSSSSGMRMGMnNdveQtrrbwjPIZWBQYSJ6dglr6F2nOJNRl0HLNMaFyE665ALDVHuHWq3dAi2yRWDXNk3o1nEDFnqQ6fsfd9L7w527Y/wW3F6tP8Tc1kyDpFDDg0I3qFU1AB5cqDlRKpfIzScoDwjX9IymtekHcjYNAN5sG2GoDwwauSYOLlBeXvakJR8MBmkOCiwdLOcFWpFElpZFQegBV7Akh1ftQN8X/1Be5se1+Q6wbb4P/T4fG2AncRPY8UX5LxbkDxuDDAwZA8QZZDRa5H3WhUwLTDvAcP1FPmPDmTfPZn1q2PYSO7r3Y0NxPjc068sDO/bmSCH3yBOlnMIqrMgJvBiU69kJN0cLuFEFI0tPzPq+4fLJzWueOli9NPD136+en9rOlvYa+XyFeQVtvryXfxx/bOPEknFfaks/Sn138fHPDx577/k5mzqKtpekSqZc35dat6Lo9fiQHSff9lce4zubr+wd07ErVXF89frOn0bqHwxb8fPKPVvfWbL7sVc6dk5prp986uie5i/2j+5o9x9xP/nl0KSFWzfuPrDl6jNjT//WIG2Ys6ni0UN1tSWXrwaHX/l274mvnj0tn762VrggTY0YR+GFT1/7U91xfn361HZ3Z9B0Nj95qVgbl3cjOmXOrn/4H94akfZvfvdG59H9e5cCMbFv2O9tdSPaF69u/3UNHqUeacGj3y/Zfv7pb8Zeq1vkdB43a3e2L/sjWLHu8Bvcx9S5igmbpK3w8Nkhu1d+JpRcrDnnXN9y5lqXfP8CPbew7QQSAAA=',
                'expire_timestamp' => '1650139819',
                'token_expire_timestamp' => NULL,
                'refresh_token' => NULL,
                'refresh_token_expire_timestamp' => NULL,
                'grant_type' => 'client_credentials',
                'token_type' => 'application_token',
                'scope' => 'https://api.ebay.com/oauth/api_scope/buy.guest.order',
                'created' => NULL,
                'modified' => NULL
            ],
        ];
        parent::init();
    }
}
