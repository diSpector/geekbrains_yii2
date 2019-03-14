<?php

namespace app\components;


use app\models\Users;
use app\models\UsersSearch;
use yii\base\Component;

class AdminComponent extends Component
{
//    public function getModel(){ // получить модель
//        $model = new Users();
//        return $model;
//    }

//    public function getAllUsers(){
//        return $this->getModel()::find();
//    }

    public function getModel($params = null){ // получить модель Пользователя - Users (ActiveRecord)
        $model = new Users();
        if($params){
            $model->load($params);
        }

        return $model;
    }

    public function getSearchProvider(){
        $model = new UsersSearch();
        return $model->getDataProvider();
    }
}