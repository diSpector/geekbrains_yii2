<?php

namespace app\controllers;

use app\base\BaseController;
use app\controllers\actions\CalendarIndexAction;
use app\controllers\actions\CalendarViewAction;

//use app\models\Activity;

class CalendarController extends BaseController
{

    public function actions(){
        return [
            'view' => [
                'class' => CalendarViewAction::class
            ],
            'index' => [
                'class' => CalendarIndexAction::class,
            ],
        ];
    }
}
