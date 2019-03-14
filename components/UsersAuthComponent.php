<?php

namespace app\components;

use app\models\Users;

use yii\base\Component;
use yii\caching\DbDependency;
use yii\caching\TagDependency;

class UsersAuthComponent extends Component
{
    /**
     * @param null $params
     * @return Users
     */
    public function getModel($params = null)
    { // получить модель Пользователя - Users (ActiveRecord)
        $model = new Users();
        if ($params) {
            $model->load($params);
        }
        return $model;
    }

    public function loginUser(&$model)
    { // попытка авторизации пользователя
        $user = $this->getUserByEmail($model->email);
        if (!$user) {
            $model->addError('email', 'Пользователя не существует');
            return false;
        }
        if (!$this->validatePassword($model->password, $user->password_hash)) {
            $model->addError('password', 'Пароль неверный');
            return false;
        }

        $user->username = $user->email;
        return \Yii::$app->user->login($user);

    }

    /**
     * @param $password
     * @param $hash
     * @return bool
     */
    private function validatePassword($password, $hash)
    { // Сравнение введенного пароля с хэшем
        return \Yii::$app->security->validatePassword($password, $hash);
    }

    /**
     * @param $email
     * @return Users|array|\yii\db\ActiveRecord
     */
    public function getUserByEmail($email)
    { // получить запись (ActiveRecord) пользователя User по email
        return $this->getModel()::find()->andWhere(['email' => $email])->one();
    }




    public function getUserById($id)
    { // получить запись (ActiveRecord) пользователя User по id
//        \Yii::$app->cache->flush();
        return $this->getModel()::find()
            ->andWhere(['id' => $id])
//            ->cache(null, new TagDependency(['tags' => 'current_user' . \Yii::$app->user->id]))
//            ->cache(null, new TagDependency(['tags' => 'current_user' . $id]))

            ->one();

//        $dependency = new TagDependency(['tags' => 'tag_name']);
//        $result = \Yii::$app->db->cache(function () use ($id) {
//            return Users::find()
//                ->where(['id'=>$id])
//                ->one();
//        }, null, $dependency);
//        return $result;

//        $result = Users::getDb()->cache(function ($db) use ($id) {
//            return Users::find()
//                ->where(['id' => $id])
//                ->one();
//        }, null, new TagDependency(['tags' => 'current_user' . \Yii::$app->user->id]));
//        return $result;
    }

    public function editUser($model)
    { // обновить данные пользователя
        if (!$model->validate(['fio'])) {
//            echo 'Валидация не прошла!';
//            print_r($model->errors);
            return false;
        }
        if (!$model->update()) {
            echo 'Обновление не удалось!';
            print_r($model->errors);
            return false;
        }

//        TagDependency::invalidate(\Yii::$app->cache, 'current_user'. \Yii::$app->user->id);
//        TagDependency::invalidate(\Yii::$app->cache, 'current_user'. $model->id);
//        TagDependency::invalidate(\Yii::$app->cache, 'tag_name');


//        \Yii::$app->cache->flush();

        return true;
    }

    /**
     * @param $model Users
     * @return bool
     */
    public function createNewUser(&$model)
    { // создать нового пользователя (записать в БД)
        if (!$model->validate(['password', 'email'])) {
            return false;
        }
//        print_r("Валидация прошла!");
        $model->password_hash = $this->hashPassword($model->password);

        // TODO: добавить транзакцию
        // TODO: триггер события, если пользователя создал админ
        if ($model->save()) { // запись в БД
            // после добавления нового пользователя ему автоматически дается роль 'user'
            $auth = \Yii::$app->authManager;
            $auth->assign($auth->getRole('user'), $model->id);
            return true;
        } else {
            print_r($model->errors);
            return false;

        }
    }


    public function deleteUser($id)
    { // удалить пользователя
        if ($this->getUserById($id)->delete()) {
            return true;
        } else {
            print_r("Ошибка при удалении");
            return false;
        }
    }

    private function hashPassword($password)
    { // получить хэш введенного пароля
        return \Yii::$app->security->generatePasswordHash($password);
    }
}