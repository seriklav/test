<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m191211_191709_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
	        'email' => $this->string(255)->notNull(),
	        'password' => $this->string(255)->notNull(),
	        'hash' => $this->string(255)->notNull(),
	        'first_name' => $this->string(255)->notNull(),
	        'last_name' => $this->string(255)->notNull(),
	        'role' => $this->tinyInteger(1),
	        'rating' => $this->decimal(15, 4),
	        'created_at' => $this->dateTime(),
	        'update_at' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
