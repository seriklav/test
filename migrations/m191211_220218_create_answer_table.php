<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%answer}}`.
 */
class m191211_220218_create_answer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%answer}}', [
            'id' => $this->primaryKey(),
            'test_id' => $this->integer(11),
	        'name' => $this->string(255)->notNull(),
	        'value' => $this->text(),
	        'correct' => $this->integer(11),
	        'balls' => $this->decimal(15, 4)
        ]);

	    // creates index for column `test_id`
	    $this->createIndex(
		    'idx-answer-test_id',
		    'answer',
		    'test_id'
	    );

	    // add foreign key for table `test`
	    $this->addForeignKey(
		    'fk-answer-test_id',
		    'answer',
		    'test_id',
		    'test',
		    'id',
		    'CASCADE'
	    );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%answer}}');
    }
}
