<?php

use yii\db\Migration;

/**
 * Class m190305_231418_Activity_Add_date_updated
 */
class m190305_231418_Activity_Add_date_updated extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('activity', 'date_updated',
            $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->after('is_completed'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('activity', 'date_updated');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190305_231418_Activity_Add_date_updated cannot be reverted.\n";

        return false;
    }
    */
}
