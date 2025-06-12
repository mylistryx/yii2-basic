<?php

namespace app\components\controllers;

use yii\web\Response;

abstract class ApiController extends WebController
{
    public function init(): void
    {
        parent::init();
        $this->response->format = Response::FORMAT_JSON;
    }
}