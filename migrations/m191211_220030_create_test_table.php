<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%test}}`.
 */
class m191211_220030_create_test_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%test}}', [
            'id' => $this->primaryKey(),
	        'name' => $this->string(255)->notNull(),
	        'description' => $this->text(),
	        'status' => $this->tinyInteger(1),
	        'viewed' => $this->integer(11),
	        'created_at' => $this->dateTime(),
	        'update_at' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%test}}');
    }
}
