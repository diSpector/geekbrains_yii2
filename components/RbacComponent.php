<?php

namespace app\components;


use app\rules\ViewActivityOwnerRule;
use yii\base\Component;

class RbacComponent extends Component
{
    /**
     * @return \yii\rbac\ManagerInterface
     */
    public function getAuthManager(){
        return \Yii::$app->authManager;
    }

    public function generateRbacRules(){
        $authManager=$this->getAuthManager();

        $authManager->removeAll(); // каждый раз удаляем все данные из таблиц авторизации

        $admin = $authManager->createRole('admin');
        $user = $authManager->createRole('user');

        // создание ролей
        $authManager->add($admin);
        $authManager->add($user);

        // создание разрешений
        $createActivity=$authManager->createPermission('createActivity');
        $createActivity->description='Создание активности';

        // объявление автономного правила для этого разрешения и привязка
        $viewOwnerRule = new ViewActivityOwnerRule();
        $authManager->add($viewOwnerRule);

        $viewActivity = $authManager->createPermission('viewActivity');
        $viewActivity->description='Просмотр активности';
        $viewActivity->ruleName = $viewOwnerRule->name;

        $viewEditAll = $authManager->createPermission('viewEditAll');
        $viewEditAll->description='Просмотр и редактирование всех активностей';

        // добавление разрешений в базу
        $authManager->add($createActivity);
        $authManager->add($viewActivity);
        $authManager->add($viewEditAll);

        // раздача разрешений ролям
        // пользователь - просмотр и создание активности
        $authManager->addChild($user, $createActivity);
        $authManager->addChild($user, $viewActivity);
        // админ - наследует от пользователя + редактирует всё
        $authManager->addChild($admin, $user);
        $authManager->addChild($admin, $viewEditAll);

        // дать конкретному пользователю конкретную роль
        $authManager->assign($user, 1); // пользователь
        $authManager->assign($admin, 2); // админ
    }

    // проверка, может ли пользователь создавать активность
    public function canCreateActivity(){
        return \Yii::$app->user->can('createActivity');
    }

//    // проверка, может ли пользователь редактировать активность
//    public function canEditActivity(){
//        return \Yii::$app->user->can('editActivity');
//    }

    // проверка, может ли пользователь просматривать/редактировать
    public function canViewEditAll(){
        return \Yii::$app->user->can('viewEditAll');

    }

    public function canViewActivity($activity){
        return \Yii::$app->user->can('viewActivity',['activity'=>$activity]);
    }
}