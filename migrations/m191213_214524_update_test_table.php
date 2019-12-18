<?php

use yii\db\Migration;

/**
 * Class m191213_214524_update_test_table
 */
class m191213_214524_update_test_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->alterColumn('test', 'status', $this->tinyInteger(1)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->alterColumn('test', 'status', $this->tinyInteger(1));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191213_214524_update_test_table cannot be reverted.\n";

        return false;
    }
    */
}
