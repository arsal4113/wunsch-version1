<?php

namespace Ebay\Lib\TradingApi\Entity;

class ApplicationDeliveryPreferences extends BaseComplexType
{
    protected $alertEmail;
    protected $alertEnable;
    protected $applicationEnable;
    protected $applicationUrl;
    protected $deliveryUrlDetails;
    protected $deviceType;
    protected $payloadVersion;

    public function setAlertEmail($alertEmail)
    {
        $this->alertEmail = $alertEmail;
    }

    public function getAlertEmail()
    {
        return $this->alertEmail;
    }

    public function setAlertEnable($alertEnable)
    {
        $this->alertEnable = $alertEnable;
    }

    public function getAlertEnable()
    {
        return $this->alertEnable;
    }

    public function setApplicationEnable($applicationEnable)
    {
        $this->applicationEnable = $applicationEnable;
    }

    public function getApplicationEnable()
    {
        return $this->applicationEnable;
    }

    public function setApplicationURL($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function getApplicationURL()
    {
        return $this->applicationUrl;
    }

    public function setDeliveryURLDetails($deliveryUrlDetails)
    {
        $this->deliveryUrlDetails = $deliveryUrlDetails;
    }

    public function getDeliveryURLDetails()
    {
        return $this->deliveryUrlDetails;
    }

    public function setDeviceType($deviceType)
    {
        $this->deviceType = $deviceType;
    }

    public function getDeviceType()
    {
        return $this->deviceType;
    }

    public function setPayloadVersion($payloadVersion)
    {
        $this->payloadVersion = $payloadVersion;
    }

    public function getPayloadVersion()
    {
        return $this->payloadVersion;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        if (!isset(self::$_elements[$this->getClassName($this)])) {
            self::$_elements[$this->getClassName($this)] = [
                'AlertEmail' => [
                    'type' => 'string',
                    'endNode' => true
                ],
                'AlertEnable' => [
                    'type' => 'string',
                    'endNode' => true
                ],
                'ApplicationEnable' => [
                    'type' => 'string',
                    'endNode' => true
                ],
                'ApplicationURL' => [
                    'type' => 'string',
                    'endNode' => true
                ],
                'DeliveryURLDetails' => [
                    'type' => 'DeliveryURLDetails',
                    'endNode' => false
                ],
                'DeviceType' => [
                    'type' => 'string',
                    'endNode' => true
                ],
                'PayloadVersion' => [
                    'type' => 'string',
                    'endNode' => true
                ]
            ];
        }
    }
}