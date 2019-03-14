<?php

namespace app\controllers;


use app\base\BaseController;
use app\components\DaoComponent;
use yii\filters\PageCache;

class DaoController extends BaseController
{
    public function behaviors()
    {
        return [
            ['class'=>PageCache::class,
                'only'=>['test'],
                'duration' => 10],
        ];
    }

    public function actionTest(){
        /** @var DaoComponent $dao */
        $dao = \Yii::$app->dao;

        $dao->insertTest(); // тест транзакции
        $users = $dao->getAllUsers();
        $activityUser = $dao->getActivityUser();
        $firstActivity = $dao->getFirstActivity();
        $countNotif = $dao->countNotificationActivity();
        $allActivityUser = $dao->getAllActivityUser(1);
        $activityReader = $dao->getActivityReader();

        return $this->render('test',
            [
                'users' => $users,
                'activityUser'=>$activityUser,
                'firstActivity'=>$firstActivity,
                'count_notif' => $countNotif,
                'allActivityUser'=>$allActivityUser,
                'activityReader'=>$activityReader,
                ]);
    }

    public function actionCache(){
        \Yii::$app->cache->set('key1', 'value1');
      \Yii::$app->cache->delete('key1');

        $value = \Yii::$app->cache->get('key1');
        $value = \Yii::$app->cache->getOrSet('key1',function(){
            return 'value2';
        });



        echo $value;
    }
}