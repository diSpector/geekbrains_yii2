<?php

namespace app\components;


use yii\base\Component;
use yii\db\conditions\InCondition;
use yii\db\Query;
use yii\log\Logger;

class DaoComponent extends Component
{
    /**
     * @return \yii\db\Connection
     */
    public function getDb()
    {
        return \Yii::$app->db;
    }

    // queryAll возвращает все записи
    public function getAllUsers()
    {
        $sql = 'select * from users';
        return $this->getDb()->createCommand($sql)->queryAll();
    }

    public function getActivityUser($id = 1)
    {
        $sql = 'select * from activity where user_id=:user';
        return $this->getDb()->createCommand($sql, ['user' => (int)$id])->queryAll();
    }

    // queryOne возвращает только первую запись
    public function getFirstActivity()
    {
        $sql = 'select * from activity limit 3';
        return $this->getDb()->createCommand($sql)->queryOne();
    }

    // queryScalar возвращает первый столбец первой записи
    public function countNotificationActivity()
    {
        $sql = 'select count(id) from activity where use_notification = 1';
        return $this->getDb()->createCommand($sql)->queryScalar();
    }

    // запрос с inner join и сортировкой через построитель запросов
    public function getAllActivityUser($id_user)
    {
        $query = new Query();
        return $query->select(['title', 'timeStart', 'email'])
            ->from('activity a')
            ->innerJoin('users u', 'a.user_id=u.id')
            ->andWhere(['a.user_id' => $id_user])
//            ->andWhere(new InCondition('user_id', 'in',[]))
            ->andWhere('a.date_created<=:date',
                [
                    ':date' => date('Y-m-d H:m:s')
                ])
            ->orderBy(['a.id' => SORT_DESC])
            ->limit(10)
            ->all(); // чтобы получить собранный sql-запрос вместо all() - createCommand->sql;
    }

    // ридер - для получения данных не целиком, а по одной строке
    public function getActivityReader()
    {
        $sql = 'select * from users';
        return $this->getDb()->createCommand($sql)->query();
    }

    // запросы с добавлением проходят через execute(), а не query()
    public function insertTest()
    {
        // транзакция - выполнение сразу нескольких запросов
        $trans = $this->getDb()->beginTransaction();
        try {
            $this->getDb()->createCommand()->insert('activity', [
                'title' => 'Новая активность',
                'dateAct' => '20-02-2019',
                'timeStart' => '14-50',
                'description' => 'Описание новой активности',
                'user_id' => 1,
            ])->execute();
            $this->getDb()->createCommand()->insert('activity', [
                'title' => 'Новая активность 2',
                'dateAct' => '20-03-2019',
                'timeStart' => '14-50',
                'description' => 'Описание новой активности 2',
                'user_id' => 1,
            ])->execute();

            $trans->commit();
        } catch (\Exception $e) {
            \Yii::getLogger()->log($e->getMessage(), Logger::LEVEL_ERROR);
            $trans->rollBack();
        }

        // транзакция с помощью анонимной функции
//        $this->getDb()->transaction(function() {
//
//        });
    }

    // добавить новую запись в таблицу activity

    /**
     * @param \app\models\Activity $activity
     */
    public function insertActivity($activity)
    {
        $this->getDb()->createCommand()->insert('activity',
            [
                'title' => $activity->title,
                'dateAct' => $activity->dateAct,
                'timeStart' => $activity->timeStart,
                'timeEnd' => $activity->timeEnd,
                'use_notification' => $activity->use_notification,
                'description' => $activity->description,
                'is_blocked' => $activity->is_blocked,
                'is_repeated' => $activity->is_repeated,
                'user_id' => 1 // пока не реализован механизм авторизации id пользователя равен 1
            ])->execute();
    }

    // получить запись из таблицы activity по id
    public function getActivityByID($id)
    {
        $sql = 'select * from activity where id=:activity_id';
        return $this->getDb()->createCommand($sql, ['activity_id' => (int)$id])->queryOne();
    }

    // обновить данные в таблице activity по id
    public function updateActivity($activity, $id)
    {
        $this->getDb()->createCommand()->update('activity', [
            'title' => $activity->title,
            'dateAct' => $activity->dateAct,
            'timeStart' => $activity->timeStart,
            'timeEnd' => $activity->timeEnd,
            'use_notification' => $activity->use_notification,
            'description' => $activity->description,
            'is_blocked' => $activity->is_blocked,
            'is_repeated' => $activity->is_repeated,
        ], 'id =' . $id)->execute();
    }

    // получить ВСЕ события для user=1
    public function getAllActivities()
    {
        $sql = 'select * from activity where user_id=1'; // заглушка для первого юзера
        return $this->getDb()->createCommand($sql)->queryAll();
    }

    // получить все события за конкретный день (пока для всех пользователей)
    public function getActivitiesByDay($day){
        $sql = 'select * from activity where dateAct=:day';
        return $this->getDb()->createCommand($sql, ['day' => $day])->queryAll();
    }
}