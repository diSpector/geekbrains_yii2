<?php

namespace app\controllers\actions;

use app\components\UsersAuthComponent;
use yii\base\Action;
use yii\web\HttpException;

class AdminNewUserAction extends Action
{
    public function run(){
        if (!\Yii::$app->rbac->canViewEditAll()) {
            throw new HttpException(403, 'У вас нет прав на просмотр этого раздела');
        }
        // т.к. экшн предполагает работу с авторизацией, будем использовать компонент авторизации и его методы
        /** @var UsersAuthComponent $comp */
        $comp = \Yii::$app->auth;
        $model = $comp->getModel(\Yii::$app->request->post());
        if(\Yii::$app->request->isPost){
            if($comp->createNewUser($model)){ // если админ создал нового пользователя
                $model->trigger($model::ADMIN_CREATE_USER); // запуск события ADMIN_CREATE_USER
                \Yii::$app->session->addFlash('success', 'Пользователь успешно добавлен, ID - ' . $model->id);
                return $this->controller->redirect(['/admin/users']);
            }
        }
        return $this->controller->render('new-user', ['model'=>$model]);
    }
}