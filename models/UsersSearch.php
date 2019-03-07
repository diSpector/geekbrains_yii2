<?php

namespace app\models;

use yii\data\ActiveDataProvider;

class UsersSearch extends Users
{
    public function getDataProvider() // получить DataProvider со всеми пользователями
    {
        $query = Users::find();

        $provider = new ActiveDataProvider(
            [
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10,
                ],
//                'sort' => [
//                    'defaultOrder' => [
//                        'timeStart' => SORT_DESC,
//                    ],
//                ],
            ]
        );

//        $query->andFilterWhere(['user_id'=>1]);
        return $provider;
    }
}