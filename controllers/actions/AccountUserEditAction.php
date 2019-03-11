<?php

namespace app\controllers\actions;


use app\components\UsersAuthComponent;
use app\models\User;
use yii\base\Action;

class AccountUserEditAction extends Action
{
    public function run(){

        if(\Yii::$app->user->isGuest){
            \Yii::$app->session->addFlash('success', 'Для просмотра этого раздела нужно авторизоваться');
            return $this->controller->redirect(['/auth/sign-in']);
        }

        /** @var UsersAuthComponent $comp */
        $comp = \Yii::$app->auth;
        /** @var User $user */

        $user = $comp->getUserById(\Yii::$app->user->id);

        if(\Yii::$app->request->isPost){
            $user->load(\Yii::$app->request->post());
            if($comp->editUser($user)){
                \Yii::$app->session->addFlash('success', 'Ваши данные изменены');
                return $this->controller->redirect(['/account/user']);
            }
        }

        return $this->controller->render('user-edit', ['user' => $user]);
    }
}