<?php

namespace app\controllers;

use app\controllers\actions\AccountIndexAction;
use app\controllers\actions\AccountUserAction;
use app\controllers\actions\AccountUserEditAction;
use yii\web\Controller;

class AccountController extends Controller
{
    public function actions(){
        return [
            'index' => [
                'class' => AccountIndexAction::class
            ],
            'user' => [
                'class' => AccountUserAction::class
            ],
            'user-edit' => [
                'class' => AccountUserEditAction::class,
            ],

        ];
    }
}