<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m191211_221619_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
	        'parent_id' => $this->integer(11),
	        'name' => $this->string(255)->notNull(),
	        'description' => $this->text(),
	        'keywords' => $this->string(255)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
