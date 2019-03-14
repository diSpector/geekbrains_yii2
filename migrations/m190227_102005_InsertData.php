<?php

use yii\db\Migration;

/**
 * Class m190227_102005_InsertData
 */
class m190227_102005_InsertData extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('user_roles', ['id' => 1, 'role' => 'Пользователь']);
        $this->insert('user_roles', ['id' => 2, 'role' => 'Администратор']);

        $this->insert('users',
            [
                'id' => 1, 'email' => 'email@email.ru', 'password_hash' => '1111',
                'fio' => 'Иван', 'date_created' => date('Y-m-d H:i:s'), 'role_id' => 1
            ]);


        $this->insert('users',
            [
                'id' => 2, 'email' => 'email2@email.ru', 'password_hash' => '1111',
                'fio' => 'Сергей', 'date_created' => date('Y-m-d H:i:s'), 'role_id' => 2]
        );

        $this->batchInsert('activity', [
            'title',
            'dateAct',
            'timeStart',
            'timeEnd',
            'use_notification',
            'description',
            'is_blocked',
            'is_repeated',
            'user_id',
            'is_completed',
            'date_created',
        ], [
            [
                'Заголовок 1',
                '01-01-2019',
                '14-10',
                '14-45',
                1,
                'Здесь подробный текст про активность',
                0,
                0,
                1,
                0,
                date('Y-m-d H:i:s'),
            ],
//            ['Заголовк 1_1',date('Y-m-d H:i:s'),1,0],
//            ['Заголовк 1_2','2018-12-12 00:00:00',1,0],
//            ['Заголовк 1_3',date('Y-m-d H:i:s'),1,1],
//            ['Заголовк 2','2018-12-12 00:00:00',2,0],
//            ['Заголовк 2',date('Y-m-d H:i:s'),1,1]
        ]);
//        $this->insert('images',['id'=> 1, 'image_name'=>'image_1','activity_id'=>'1']);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('users');
        $this->delete('activity');
        $this->delete('user_roles');


    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190227_102005_InsertData cannot be reverted.\n";

        return false;
    }
    */
}
