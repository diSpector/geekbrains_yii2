<?php

namespace app\components\activity;


use yii\data\ActiveDataProvider;

class ActivitySearchService implements ActivitySearchInterface
{

    public function getDataProvider()
    {
        $query = \Yii::$container->get('ActivityEntity')::find();

        $provider = new ActiveDataProvider(
            [
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]
        );

        return $provider;
    }

    public function getDataProviderWithQuery($queryArr){
        $query = \Yii::$container->get('ActivityEntity')::find();

        $provider = new ActiveDataProvider(
            [
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]
        );

        $query->andFilterWhere($queryArr);
        return $provider;
    }
}