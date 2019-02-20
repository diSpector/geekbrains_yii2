<?php
/**
 * Created by PhpStorm.
 * User: Ирина
 * Date: 20.02.2019
 * Time: 13:13
 */

namespace app\controllers;

use app\base\BaseController;
use app\controllers\actions\DayAddAction;

class DayController extends BaseController
{
    public function actions()
    {
        return [
            'add' => [
                'class' => DayAddAction::class
            ]
        ];
    }
}