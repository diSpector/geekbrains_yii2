<?php

namespace app\models;

use yii\data\ActiveDataProvider;

class ActivitySearch extends Activity
{
    public function getDataProvider()
    {
        $query = Activity::find();

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