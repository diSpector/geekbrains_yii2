<?php

namespace app\components;
use app\models\Users;

use yii\base\Component;

class UsersAuthComponent extends Component
{
    /**
     * @param null $params
     * @return Users
     */
    public function getModel($params = null){ // получить модель Пользователя - Users (ActiveRecord)
        $model = new Users();
        if($params){
            $model->load($params);
        }

        return $model;
    }

    public function loginUser(&$model){ // попытка авторизации пользователя
        $user = $this->getUserByEmail($model->email);
        if(!$user){
            $model->addError('email', 'Пользователя не существует');
            return false;
        }
        if(!$this->validatePassword($model->password, $user->password_hash)){
            $model->addError('password', 'Пароль неверный');
            return false;
        }

        $user->username=$user->email;
        return \Yii::$app->user->login($user);

    }

    /**
     * @param $password
     * @param $hash
     * @return bool
     */
    private function validatePassword($password, $hash){ // Сравнение введенного пароля с хэшем
        return \Yii::$app->security->validatePassword($password, $hash);
    }

    /**
     * @param $email
     * @return Users|array|\yii\db\ActiveRecord
     */
    public function getUserByEmail($email){ // получить запись (ActiveRecord) пользователя User по email
        return $this->getModel()::find()->andWhere(['email' => $email])->one();
    }

    /**
     * @param $model Users
     * @return bool
     */
    public function createNewUser(&$model){ // создать нового пользователя (записать в БД)
        if(!$model->validate(['password', 'email'])){
            return false;
        }
        $model->password_hash=$this->hashPassword($model->password);

        if($model->save()){ // запись в БД
            // после добавления нового пользователя ему автоматически дается роль 'user'
            $auth = \Yii::$app->authManager;
            $auth->assign($auth->getRole('user'), $model->id);
            return true;
        }

        return false;
    }

    private function hashPassword($password){ // получить хэш введенного пароля
        return \Yii::$app->security->generatePasswordHash($password);
    }
}