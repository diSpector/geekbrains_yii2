<?php

use yii\db\Migration;

/**
 * Class m190303_002140_Alter_Users
 */
class m190303_002140_Alter_Users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // обновить значения в ячейках email и password_hash все строки из таблицы users
        $this->update('users',
            [
                'email' => 'test@test.ru',
                'password_hash' => \Yii::$app->security->generatePasswordHash('123456')

            ],
            ['id' => 1]);

        $this->update('users',
            [
                'email' => 'test2@test.ru',
                'password_hash' => \Yii::$app->security->generatePasswordHash('123456')

            ],
            ['id' => 2]);


        // задать столбцу email св-во уникальности
        $this->createIndex('unique_email', 'users', 'email', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->update('users',
            [
                'email' => 'email@email.ru',
                'password_hash' => '1111',

            ],
            ['id' => 1]);

        $this->update('users',
            [
                'email' => 'email2@email.ru',
                'password_hash' => '1111',

            ],
            ['id' => 2]);

        $this->dropIndex('unique_email', 'users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190303_002140_Alter_Users cannot be reverted.\n";

        return false;
    }
    */
}
