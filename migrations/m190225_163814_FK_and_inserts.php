<?php

use yii\db\Migration;

/**
 * Class m190225_163814_FK_and_inserts
 */
class m190225_163814_FK_and_inserts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('activity','user_id',$this->integer()->notNull());

        $this->addForeignKey('user_activity_FK',
            'activity','user_id',
            'users','id','CASCADE','CASCADE');

        $this->createIndex('asdf','users','email',true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('user_activity_FK','activity');
        $this->dropColumn('activity','user_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190225_163814_FK_and_inserts cannot be reverted.\n";

        return false;
    }
    */
}
