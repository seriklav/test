<?php

namespace app\modules\admin\models;

use Yii;

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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['status', 'viewed'], 'integer'],
            [['created_at', 'update_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'viewed' => 'Viewed',
            'created_at' => 'Created At',
            'update_at' => 'Update At',
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
