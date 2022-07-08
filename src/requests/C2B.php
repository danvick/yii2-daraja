<?php

namespace danvick\daraja\requests;

use danvick\daraja\Daraja;
use yii\base\Exception;
use yii\base\InvalidConfigException;

/**
 *
 * @property-write string $commandId
 */
class C2B extends Daraja
{
    /**
     * The Safaricom C2B API end point for registering the confirmation
     * and validation URLs.
     *
     * @var string
     */
    protected $urlRegistrationEndPoint = 'mpesa/c2b/v1/registerurl';

    /**
     * The Safaricom C2B API end point for simulating a C2B transaction.
     *
     * @var string
     */
    protected $simulationEndpoint = 'mpesa/c2b/v1/simulate';

    /**
     * The Safaricom C2B API command ID.
     *
     * @var string
     */
    protected $commandID;

    /**
     * Register the confirmation and validation URLs to the Safaricom C2B API.
     *
     * @param string $confirmationUrl
     * @param string $validationUrl
     * @param string $responseType
     * @param null|string $shortCode
     * @return mixed
     * @throws Exception
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function registerUrls(string $confirmationUrl, string $validationUrl, string $responseType = 'Completed', string $shortCode = null)
    {
        $parameters = [
            'ShortCode' => is_null($shortCode) ? $this->shortCode : $shortCode,
            'ResponseType' => $responseType,
            'ConfirmationURL' => $confirmationUrl,
            'ValidationURL' => $validationUrl,
        ];

        return $this->call($this->urlRegistrationEndPoint, 'POST', ['json' => $parameters]);
    }

    /**
     * Set the command ID to be used for the transaction.
     *
     * @param string $commandId
     */
    public function setCommandId(string $commandId)
    {
        $this->commandID = $commandId;
    }

    /**
     * Simulate customer payment to a pay bill number through Safaricom C2B API.
     *
     * @param string $phoneNumber
     * @param string $amount
     * @param string $reference
     * @param string|null $shortCode
     * @return mixed
     * @throws Exception
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function simulatePaymentToPaybill(string $phoneNumber, string $amount, string $reference, string $shortCode = null)
    {
        $this->setCommandId('CustomerPayBillOnline');

        return $this->simulate($phoneNumber, $amount, $reference, $shortCode);
    }

    /**
     * Simulate customer payment to a till number through Safaricom C2B API.
     *
     * @param string $phoneNumber
     * @param string $amount
     * @param string $reference
     * @param string|null $shortCode
     * @return mixed
     * @throws Exception
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function simulatePaymentToTill(string $phoneNumber, string $amount, string $reference, string $shortCode = null)
    {
        $this->setCommandId('CustomerBuyGoodsOnline');

        return $this->simulate($phoneNumber, $amount, $reference, $shortCode);
    }

    /**
     * Send the transaction to be simulated to the Safaricom C2B API.
     *
     * @param $phoneNumber
     * @param $amount
     * @param $reference
     * @param null $shortCode
     * @return mixed
     * @throws Exception
     * @throws InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    protected function simulate($phoneNumber, $amount, $reference, $shortCode = null)
    {
        $parameters = [
            'ShortCode' => is_null($shortCode) ? $this->shortCode : $shortCode,
            'CommandID' => $this->commandID,
            'Amount' => $amount,
            'Msisdn' => $phoneNumber,
            'BillRefNumber' => $reference,
        ];

        return $this->call($this->simulationEndpoint,'POST',  ['json' => $parameters]);
    }
}