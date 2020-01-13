<?php

use yii\db\Migration;

/**
 * Class m200113_134059_create_table_session
 */
class m200113_134059_create_table_session extends Migration
{
	/**
	 *
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('{{%session}}', [
			'session_id' => $this->primaryKey(),
			'id' => $this->char(40),
			'data' => $this->binary(429496729),
			'user_id' => $this->integer(11),
			'expire' => $this->integer(),
			'last_activity' => $this->dateTime(),
			'last_ip' => $this->string(255)
		]);

		// creates index for column `test_id`
		$this->createIndex(
			'idx-session-user_id',
			'session',
			'user_id'
		);

		// add foreign key for table `user`
		$this->addForeignKey(
			'fk-session-user_id',
			'session',
			'user_id',
			'user',
			'id',
			'CASCADE'
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropIndex('idx-session-user_id', 'session');
		$this->dropForeignKey('fk-session-user_id', 'session');
		$this->dropTable('{{%session}}');
	}
}
