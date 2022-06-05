<?php
namespace Ebay\Lib\BuyApi\OrderApi\Entity;


class MarketingTerm extends AbstractEntity
{
    const MARKETING_CHANNEL_EMAIL = 'EMAIL';
    const MARKETING_TYPE_OFFER = 'OFFER';
    const MARKETING_TYPE_PROMOTION = 'PROMOTION';
    const MARKETING_TYPE_SURVEY = 'SURVEY';

    /**
     * @var array
     */
    protected $marketingChannels = [];

    /**
     * @var boolean
     */
    protected $marketingTermsAccepted;

    /**
     * @var array
     */
    protected $marketingTypes = [];

    /**
     * @return array
     */
    public function getMarketingChannels()
    {
        return $this->marketingChannels;
    }

    /**
     * @param array $marketingChannels
     * @return MarketingTerm
     */
    public function setMarketingChannels($marketingChannels)
    {
        $this->marketingChannels = $marketingChannels;
        return $this;
    }

    /**
     * @param string $marketingChannel
     * @return MarketingTerm
     */
    public function appendMarketingChannel($marketingChannel)
    {
        $this->marketingChannels[] = $marketingChannel;
        return $this;
    }

    /**
     * @return bool
     */
    public function isMarketingTermsAccepted()
    {
        return $this->marketingTermsAccepted;
    }


    /**
     * @param bool $marketingTermsAccepted
     * @return MarketingTerm
     */
    public function setMarketingTermsAccepted($marketingTermsAccepted)
    {
        $this->marketingTermsAccepted = $marketingTermsAccepted;
        return $this;
    }

    /**
     * @return array
     */
    public function getMarketingTypes()
    {
        return $this->marketingTypes;
    }

    /**
     * @param array $marketingTypes
     * @return MarketingTerm
     */
    public function setMarketingTypes($marketingTypes)
    {
        $this->marketingTypes = $marketingTypes;
        return $this;
    }

    /**
     * @param string $marketingType
     * @return MarketingTerm
     */
    public function appendMarketingType($marketingType)
    {
        $this->marketingTypes[] = $marketingType;
        return $this;
    }

}
