<?php

namespace app\controllers\actions;

use app\components\UsersAuthComponent;
use yii\base\Action;
use yii\web\HttpException;

class AdminUserEditAction extends Action
{
    public function run($id){

        if(!isset($id)){
            throw new HttpException(400, 'Не указан id пользователя');
        }
        $comp = \Yii::$app->auth;
        // получить запись (ActiveRecord) пользователя
        $user = $comp->getUserById($id);
        if(!$user){
            throw new HttpException(400, 'Пользователя с таким id не существует');
        }

        if (!\Yii::$app->rbac->canViewEditAll()) {
            throw new HttpException(403, 'У вас нет прав на просмотр этого раздела');
        }
        /** @var UsersAuthComponent $comp */

        if(\Yii::$app->request->isPost){ // если пришел post-запрос
            $user->load(\Yii::$app->request->post());
            if($comp->editUser($user)){
                \Yii::$app->session->addFlash('success', 'Данные пользователя изменены');
                return $this->controller->redirect(['/admin/users']);
            }
        }

        return $this->controller->render('user-edit',['user' => $user]);
    }
}