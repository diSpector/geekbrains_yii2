<?php

use yii\db\Migration;

/**
 * Class m190302_235640_Drop_Tables_Roles_Authorize
 */

// миграция для удаления таблиц с ролями пользователей и авторизованными пользователями и их внешних ключей,
// т.к. этот функционал реализован с помощью RBAC
class m190302_235640_Drop_Tables_Roles_Authorize extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // удаление внешнего ключа с таблицы users на таблицу user_roles
        $this->dropForeignKey('user_role_FK', 'users');

        // удаление внешнего ключа с таблицы authorize_users на таблицу users
        $this->dropForeignKey('authorize_user_id_FK', 'authorize_users');

        // удаление внешнего ключа с таблицы authorize_users на таблицу users
        $this->dropForeignKey('authorize_user_role_FK', 'authorize_users');

        // таблица с правами пользователей
        $this->dropTable('user_roles');

        // таблица с датой/временем последней авторизации пользователя
        $this->dropTable('authorize_users');

        // удаление столбца role_id из таблицы users
        $this->dropColumn('users', 'role_id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
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

        // добавить столбец role_id в таблицу users
        $this->addColumn('users', 'role_id', $this->integer());

        // внешний ключ - таблицы пользователей и их ролей
        $this->addForeignKey('user_role_FK',
            'users', 'role_id',
            'user_roles', 'id', 'CASCADE', 'CASCADE');

        // внешний ключ - таблицы авторизованных пользователей и пользователей
        $this->addForeignKey('authorize_user_id_FK',
            'authorize_users', 'user_id',
            'users', 'id', 'CASCADE', 'CASCADE');

        // внешний ключ - таблицы авторизованных пользователей и их ролей
        $this->addForeignKey('authorize_user_role_FK',
            'authorize_users', 'user_role_id',
            'user_roles', 'id', 'CASCADE', 'CASCADE');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190302_235640_Drop_Tables_Roles_Authorize cannot be reverted.\n";

        return false;
    }
    */
}
