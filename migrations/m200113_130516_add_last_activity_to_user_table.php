<?php

use yii\db\Migration;

/**
 * Class m200113_130516_add_last_activity_to_user_table
 */
class m200113_130516_add_last_activity_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->addColumn('user', 'last_ip', $this->string(100));
	    $this->addColumn('user', 'last_activity', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropColumn('user', 'position');
	    $this->dropColumn('user', 'last_activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200113_130516_add_last_activity_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
