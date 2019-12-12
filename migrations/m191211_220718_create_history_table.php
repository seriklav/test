<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%history}}`.
 */
class m191211_220718_create_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%history}}', [
            'id' => $this->primaryKey(),
	        'test_id' => $this->integer(11),
	        'user_id' => $this->integer(11),
	        'balls' => $this->decimal(15, 4),
	        'created_at' => $this->dateTime(),
        ]);

	    // creates index for column `test_id`
	    $this->createIndex(
		    'idx-history-test_id',
		    'history',
		    'test_id'
	    );

	    // creates index for column `user_id`
	    $this->createIndex(
		    'idx-history-user_id',
		    'history',
		    'user_id'
	    );

	    // add foreign key for table `user`
	    $this->addForeignKey(
		    'fk-history-user_id',
		    'history',
		    'user_id',
		    'user',
		    'id',
		    'CASCADE'
	    );

	    // add foreign key for table `test`
	    $this->addForeignKey(
		    'fk-history-test_id',
		    'history',
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
        $this->dropTable('{{%history}}');
    }
}
