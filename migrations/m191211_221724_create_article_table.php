<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article}}`.
 */
class m191211_221724_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
	        'category_id' => $this->integer(11),
	        'name' => $this->string(255)->notNull(),
	        'description' => $this->text(),
	        'created_at' => $this->dateTime(),
	        'update_at' => $this->dateTime()
        ]);

	    // creates index for column `category_id`
	    $this->createIndex(
		    'idx-article-category_id',
		    'article',
		    'category_id'
	    );

	    // add foreign key for table `test`
	    $this->addForeignKey(
		    'fk-article-category_id',
		    'article',
		    'category_id',
		    'category',
		    'id',
		    'CASCADE'
	    );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article}}');
    }
}
