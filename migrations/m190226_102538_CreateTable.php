<?php

use yii\db\Migration;

/**
 * Class m190226_102538_CreateTable
 */
class m190226_102538_CreateTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // создание таблицы активностей
        $this->createTable('activity',[
            'id'=>$this->primaryKey(),
            'title'=>$this->string(150)->notNull(),

            // чтобы не усложнять разработку на этом этапе, все поля с датами/временем
            // ожидают строчных данных
            // TODO: перепилить форму, чтобы она предоставляла данные в формате даты/времени
            'dateAct' => $this->string()->notNull(),
            'timeStart'=>$this->string()->notNull(),
            'timeEnd'=>$this->string(),

            'use_notification'=>$this->boolean()->notNull()->defaultValue(0),
            'description'=>$this->text()->notNull(),
            'is_blocked'=>$this->boolean()->notNull()->defaultValue(0),
            'is_repeated'=>$this->boolean()->notNull()->defaultValue(0),
            'user_id' => $this->integer()->notNull(),

            // выполнено событие или нет: по умолчанию нет (0)
            'is_completed' => $this->boolean()->defaultValue(0),
            'date_created'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        // таблица пользователей
        $this->createTable('users',[
            'id'=>$this->primaryKey(),
            'email'=>$this->string(150)->notNull(),
            'password_hash'=>$this->string(300)->notNull(),
            'token'=>$this->string(150),
            'fio'=>$this->string(150),
            // id роли пользователя: user - 1, admin - 2
            'role_id' => $this->integer()->notNull()->defaultValue(1),
            'date_created'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        // таблица с именами загруженных картинок
        $this->createTable('images',[
            'id'=>$this->primaryKey(),
            'image_name'=>$this->string(150)->notNull(),
            'activity_id'=>$this->integer()->notNull(),
            'date_created'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        // таблица с правами пользователей
        $this->createTable('user_roles', [
            'id'=> $this->primaryKey(),
            'role'=>$this->string()->notNull(),
        ]);

        // таблица с датой/временем последней авторизации пользователя
        $this->createTable('authorize_users', [
            'id'=>$this->primaryKey(),
            'user_id'=>$this->integer()->notNull(),
            'user_role_id'=>$this->integer()->notNull(),
            'date_authorized'=>$this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
        $this->dropTable('activity');
        $this->dropTable('images');
        $this->dropTable('user_roles');
        $this->dropTable('authorize_users');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190226_102538_CreateTable cannot be reverted.\n";

        return false;
    }
    */
}
