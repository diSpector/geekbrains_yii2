<?php
/**
 * Created by PhpStorm.
 * User: Ирина
 * Date: 04.03.2019
 * Time: 4:41
 */

namespace app\controllers\actions;


use yii\base\Action;

// экшн авторизации (попытка залогиниться существующим пользователем)
class SignInAction extends Action
{
    public function run(){
        /** @var \app\components\UsersAuthComponent $comp */
        $comp = \Yii::$app->auth;

        $model = $comp->getModel(\Yii::$app->request->post());

        if(\Yii::$app->request->isPost){
            if($comp->loginUser($model)){ // если данные формы были отправлены и авторизация прошла успешно

                \Yii::$app->session->addFlash('success', 'Вы успешно авторизованы как пользователь - ' . $model->email);

                if (\Yii::$app->rbac->canViewEditAll()) {
                    return $this->controller->redirect(['/admin/index']);
                }

                return $this->controller->redirect(['/calendar/view']);
            }

        }

        return $this->controller->render('signin', ['model'=>$model]);
    }
}