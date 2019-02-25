<?php

use yii\db\Migration;

/**
 * Class m190225_164520_inserts
 */
class m190225_164520_inserts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('users',['id'=>1,'email'=>'email@email.ru','password_hash'=>'1111',
            'fio'=>'f i o']);
        $this->insert('users',['id'=>2,'email'=>'email2@email.ru','password_hash'=>'1111',
            'fio'=>'f2 i2 o2']);


        $this->batchInsert('activity',[
            'title','timeStart','user_id','use_notification'
        ],[
            ['Заголовк 1',date('Y-m-d H:i:s'),1,0],
            ['Заголовк 1_1',date('Y-m-d H:i:s'),1,0],
            ['Заголовк 1_2','2018-12-12 00:00:00',1,0],
            ['Заголовк 1_3',date('Y-m-d H:i:s'),1,1],
            ['Заголовк 2','2018-12-12 00:00:00',2,0],
            ['Заголовк 2',date('Y-m-d H:i:s'),1,1]
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190225_164520_inserts cannot be reverted.\n";

        return false;
    }
    */
}
