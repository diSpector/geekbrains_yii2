<?php

use yii\db\Migration;

/**
 * Class m190303_010847_Activity_Alter_Date
 */
class m190303_010847_Activity_Alter_Date extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // удалить вторичный ключ с таблицы images, все строки из таблицы activity,
        // поменять тип даты на timestamp, наполнить первоначальными данными,
        // вернуть вторичный ключ
        $this->dropForeignKey('activity_images_FK', 'images');
        $this->truncateTable('activity');
        $this->alterColumn('activity', 'dateAct', $this->timestamp()->notNull());
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
                '20190202',
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
        ]);

        $this->addForeignKey('activity_images_FK',
            'images','activity_id',
            'activity','id','CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('activity_images_FK', 'images');
        $this->truncateTable('activity');
        $this->alterColumn('activity', 'dateAct', $this->string()->notNull());
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
        ]);

        $this->addForeignKey('activity_images_FK',
            'images','activity_id',
            'activity','id','CASCADE','CASCADE');


    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190303_010847_Activity_Alter_Date cannot be reverted.\n";

        return false;
    }
    */
}
