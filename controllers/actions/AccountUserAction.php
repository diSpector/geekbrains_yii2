<?php

namespace app\controllers\actions;

use app\components\UsersAuthComponent;
use yii\base\Action;


class AccountUserAction extends Action
{
    public function run(){

        if(\Yii::$app->user->isGuest){
            \Yii::$app->session->addFlash('success', 'Для просмотра этого раздела нужно авторизоваться');
            return $this->controller->redirect(['/auth/sign-in']);
        }

        /** @var UsersAuthComponent $comp */
        $comp = \Yii::$app->auth;
        $user = $comp->getUserById(\Yii::$app->user->id);

        return $this->controller->render('user', ['user' => $user]);
    }
}