<?php

namespace danvick\daraja\commands;


use danvick\daraja\requests\C2B;
use Yii;
use yii\console\Controller;
use yii\helpers\VarDumper;

class DarajaCliController extends Controller
{
    /*public function init()
    {
        parent::init();
        \Yii::$app->has()
    }*/

    public function actionRegisterUrls(string $confirmationUrl, string $validationUrl, string $responseType = 'Completed', string $shortCode = null)
    {
        $response = Yii::$app->daraja->registerUrls($confirmationUrl, $validationUrl, $responseType, $shortCode);
        echo VarDumper::dumpAsString($response);
    }

    public function actionSimulatePaybillPayment(string $phoneNumber, string $amount, string $reference, string $shortCode = null)
    {
        $response = Yii::$app->daraja->simulatePaymentToPaybill($phoneNumber, $amount, $reference, $shortCode);
        echo VarDumper::dumpAsString($response);
    }
}