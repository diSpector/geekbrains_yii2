<?php

namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\AdminActivitiesAction;
use app\controllers\actions\AdminIndexAction;
use app\controllers\actions\AdminNewUserAction;
use app\controllers\actions\AdminUserDeleteAction;
use app\controllers\actions\AdminUserEditAction;
use app\controllers\actions\AdminUsersAction;

class AdminController extends BaseController
{
    public function actions(){
        return [
            'users' => [
                'class' => AdminUsersAction::class
            ],
            'activities' => [
                'class' => AdminActivitiesAction::class
            ],
            'new-user' => [
                'class' => AdminNewUserAction::class
            ],
            'user-edit' => [
                'class' => AdminUserEditAction::class,
            ],
            'user-delete' => [
                'class' => AdminUserDeleteAction::class,
            ],
            'index' => [
                'class' => AdminIndexAction::class,
            ]
        ];
    }
}