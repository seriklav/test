<?php

namespace app\modules\user\models;

use app\modules\admin\models\Test;
use Yii;

/**
 * This is the model class for table "history".
 *
 * @property int $id
 * @property int|null $test_id
 * @property string|null $test_name
 * @property int|null $user_id
 * @property float|null $balls
 * @property string|null $created_at
 *
 * @property Test $test
 * @property User $user
 */
class History extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_id', 'user_id'], 'integer'],
            [['balls'], 'number'],
            [['created_at'], 'safe'],
            [['test_name'], 'safe'],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['test_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
	        'test_name' => 'Название теста',
            'test_id' => 'Название теста',
            'balls' => 'Балы',
            'created_at' => 'Дата прохождения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
