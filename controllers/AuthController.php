<?php

namespace app\controllers;

use app\components\UsersAuthComponent;
use yii\web\Controller;
use app\controllers\actions\SignInAction;
use app\controllers\actions\SignUpAction;


class AuthController extends Controller
{
    public function actions(){
        return [
            'sign-in' => [
                'class' => SignInAction::class
            ],
            'sign-up' => [
                'class' => SignUpAction::class
            ],
        ];
    }

//    public function actionSignIn(){ // экшн авторизации (попытка залогиниться существующим пользователем)
//        /** @var UsersAuthComponent $comp */
//        $comp = \Yii::$app->auth;
//
//        $model = $comp->getModel(\Yii::$app->request->post());
//
//        if(\Yii::$app->request->isPost){
//            if($comp->loginUser($model)){ // если данные формы были отправлены и авторизация прошла успешно
//
//                \Yii::$app->session->addFlash('success', 'Вы успешно авторизованы как пользователь - ' . $model->email);
//                return $this->redirect(['/calendar/view']);
//            }
//
//        }
//
//        return $this->render('signin', ['model'=>$model]);
//    }

//    public function actionSignUp(){ // экшн регистрации нового пользователя
//        /** @var UsersAuthComponent $comp */
//       $comp = \Yii::$app->auth;
//
//       $model = $comp->getModel(\Yii::$app->request->post());
//       if(\Yii::$app->request->isPost){
//            if($comp->createNewUser($model)){
//                // если удалось создать нового пользователя, сразу залогинить его и перекинуть на страницу создания активности
//                $comp->loginUser($model);
//                \Yii::$app->session->addFlash('success', 'Пользователь успешно добавлен, ID - ' . $model->id);
//                return $this->redirect(['/calendar/view']);
//            }
//       }
//
//       return $this->render('signup', ['model'=>$model]);
//    }
}