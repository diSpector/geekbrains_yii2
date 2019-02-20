<?php

namespace app\base;

class BaseController extends \yii\web\Controller
{
    public function afterAction($action, $result) // переопределенный метод для сохранения последней посещенной страницы пользователя
    {
        // последняя сохраненная страница выводится в футере над копирайтом
        $session = \Yii::$app->session;
        $session->open();
        $session->set('lastPage', \Yii::$app->request->absoluteUrl); // записать в ключ lastPage сессии адрес страницы
        return parent::afterAction($action, $result); //
    }
}