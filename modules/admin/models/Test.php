<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "test".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $status
 * @property int|null $viewed
 * @property string|null $created_at
 * @property string|null $update_at
 *
 * @property Answer[] $answers
 * @property History[] $histories
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test';
    }

	/**
	 * @return array
	 */
	public function behaviors()
	{
		return [
			[
				'class' => TimestampBehavior::className(),
				'attributes' => [
					ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'update_at'],
					ActiveRecord::EVENT_BEFORE_UPDATE => ['update_at'],
				],
				'value' => new Expression('NOW()'),
			]
		];
	}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Теста',
            'name' => 'Имя',
            'description' => 'Описание',
            'viewed' => 'Пройденно',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::className(), ['test_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistories()
    {
        return $this->hasMany(History::className(), ['test_id' => 'id']);
    }
}
