<?php
/**
 * Created by PhpStorm.
 * User: Talisman
 * Date: 25.02.2019
 * Time: 20:12
 */

namespace app\components;


use yii\base\Component;
use yii\db\conditions\InCondition;
use yii\db\Query;
use yii\log\Logger;

class DAOComponent extends Component
{
    /**
     * @return \yii\db\Connection
     */
    public function getDb(){
        return \Yii::$app->db;
    }

    public function getAllUsers(){
        $sql='select * from users';

        return $this->getDb()->createCommand($sql)->queryAll();
    }

    public function getActivityUser($id=2){
        $sql='select * from activity where user_id=:user';
        return $this->getDb()->createCommand($sql,[':user'=>(int)$id])->queryAll();
    }

    public function getFirstActivity(){
        $sql='select * from activity limit 3';
        return $this->getDb()->createCommand($sql)->queryOne();
    }

    public function countNotificationActivity(){
        $sql='select count(id) from activity where use_notification=1';

        return $this->getDb()->createCommand($sql)->queryScalar();
    }

    public function getAllActivityUser($id_user){
        $query=new Query();

        return $query->select(['title','timeStart','email'])
            ->from('activity a')
            ->innerJoin('users u','a.user_id=u.id')
            ->andWhere(['a.user_id'=>$id_user])
//            ->andWhere(new InCondition('user_id','in',[]))
            ->andWhere('a.date_created<=:date',[':date' => date('Y-m-d H:i:s')])
            ->orderBy(['a.id'=>SORT_DESC])
            ->limit(10)
            ->createCommand()->rawSql;
    }

    public function getActivityReader(){
        $sql='select * from users';

        return $this->getDb()->createCommand($sql)->query();
    }

    public function insertTest(){
        $trans=$this->getDb()->beginTransaction();
        try{
            $this->getDb()->createCommand()->insert('activity',[
                'user_id'=>2,
                'title'=>'title3',
                'timeStart'=>date('Y-m-d H:i:s')
            ])->execute();
//            throw new \Exception('test');

            $this->getDb()->createCommand()->insert('activity',[
                'user_id'=>2,
                'title'=>'title4',
                'timeStart'=>date('Y-m-d H:i:s')
            ])->execute();

            $trans->commit();
        }catch (\Exception $e){
            \Yii::getLogger()->log($e->getMessage(),Logger::LEVEL_ERROR);
            $trans->rollBack();
        }


//        $this->getDb()->transaction(function (){
//
//        });
    }
}