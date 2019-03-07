<?php

use yii\db\Migration;

/**
 * Class m190227_094651_ForeignKey_images
 */
class m190227_094651_ForeignKey_images extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // связь между:
        // таблицей активностей и загруженных картинок

        // чтобы добавить вторичный ключ столбец таблицы должен быть индексом
//        $this->createIndex('idx_image_activity', 'images', 'activity_id');

        $this->addForeignKey('activity_images_FK',
            'images','activity_id',
            'activity','id','CASCADE','CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('activity_images_FK','images');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190227_094651_ForeignKey_images cannot be reverted.\n";

        return false;
    }
    */
}
