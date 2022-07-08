<?php

namespace danvick\daraja\commands;


use danvick\daraja\requests\C2B;
use Yii;
use yii\console\Controller;

class DarajaCliController extends Controller
{
    /*public function init()
    {
        parent::init();
        \Yii::$app->has()
    }*/

    public function actionRegisterUrls(string $confirmationUrl, string $validationUrl, string $responseType = 'Completed')
    {
        /** @var C2B $c2b */
        $c2b = Yii::$app->get('daraja')->c2b;
    }
}