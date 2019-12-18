<?php

use yii\db\Migration;

/**
 * Class m191213_121318_update_user_table
 */
class m191213_121318_update_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->dropColumn('user', 'hash');
	    $this->addColumn('user', 'auth_key', $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

	    $this->addColumn('user', 'hash', $this->string(255));
	    $this->dropColumn('user', 'auth_key');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191213_121318_update_user_table cannot be reverted.\n";

        return false;
    }
    */
}
