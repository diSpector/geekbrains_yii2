<?php

namespace app\controllers\actions;


use yii\base\Action;

// экшн регистрации нового пользователя
class SignUpAction extends Action
{
    public function run(){
        /** @var \app\components\UsersAuthComponent $comp */
        $comp = \Yii::$app->auth;

        $model = $comp->getModel(\Yii::$app->request->post());
        if(\Yii::$app->request->isPost){
            if($comp->createNewUser($model)){
                // если удалось создать нового пользователя, сразу залогинить его и перекинуть на страницу создания активности
                $comp->loginUser($model);
                \Yii::$app->session->addFlash('success', 'Пользователь успешно добавлен, ID - ' . $model->id);
                return $this->controller->redirect(['/calendar/view']);
            }
        }

        return $this->controller->render('signup', ['model'=>$model]);
    }
}