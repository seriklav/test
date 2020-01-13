<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "answer".
 *
 * @property int $id
 * @property int|null $test_id
 * @property string $name
 * @property string|null $value
 * @property array|null $values
 * @property int|null $ref_test_id
 * @property int|null $correct
 * @property float|null $balls
 *
 * @property Test $test
 */
class Answer extends \yii\db\ActiveRecord
{
	public $values = [];
	public $ref_test_id = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'answer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_id', 'correct'], 'integer'],
            [['name'], 'required'],
            [['values'], 'safe'],
            [['balls', 'correct'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['test_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_id' => 'Тест',
            'name' => 'Запитання',
            'correct' => 'Правильна відповідь',
            'balls' => 'Бали',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }
}
