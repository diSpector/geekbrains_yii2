<?php

namespace app\controllers;


use app\models\Activity;
use app\models\User;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class ActivityRestController extends ActiveController
{
    public $modelClass = Activity::class;

    public function behaviors()
    {
        return array_merge([
            'authentificator'=>[
                'class'=>HttpBearerAuth::class,
//                'user'=>User::class,
            ]
        ], parent::behaviors());
    }
}