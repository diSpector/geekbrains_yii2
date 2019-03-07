<?php

use yii\db\Migration;

/**
 * Class m190227_092337_ForeignKeys
 */
class m190227_092337_ForeignKeys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // создание вторичных ключей для связи между:
        // таблицей активностей и пользователей
        $this->addForeignKey('user_activity_FK',
            'activity', 'user_id',
            'users', 'id', 'CASCADE', 'CASCADE');

        // таблицы пользователей и их ролей
        $this->addForeignKey('user_role_FK',
            'users', 'role_id',
            'user_roles', 'id', 'CASCADE', 'CASCADE');

        // таблицы авторизованных пользователей и пользователей
        $this->addForeignKey('authorize_user_id_FK',
            'authorize_users', 'user_id',
            'users', 'id', 'CASCADE', 'CASCADE');

        // таблицы авторизованных пользователей и их ролей
        $this->addForeignKey('authorize_user_role_FK',
            'authorize_users', 'user_role_id',
            'user_roles', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // удаление вторичных ключей при откате миграции
        $this->dropForeignKey('user_activity_FK', 'activity');
        $this->dropForeignKey('user_role_FK', 'users');
        $this->dropForeignKey('authorize_user_id_FK', 'authorize_users');
        $this->dropForeignKey('authorize_user_role_FK', 'authorize_users');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190227_092337_ForeignKeys cannot be reverted.\n";

        return false;
    }
    */
}
