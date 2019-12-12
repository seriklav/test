<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $hash
 * @property string $first_name
 * @property string $last_name
 * @property int|null $role
 * @property float|null $rating
 * @property string|null $created_at
 * @property string|null $update_at
 *
 * @property History[] $histories
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password', 'hash', 'first_name', 'last_name'], 'required'],
            [['role'], 'integer'],
            [['rating'], 'number'],
            [['created_at', 'update_at'], 'safe'],
            [['email', 'password', 'hash', 'first_name', 'last_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'hash' => 'Hash',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'role' => 'Role',
            'rating' => 'Rating',
            'created_at' => 'Created At',
            'update_at' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistories()
    {
        return $this->hasMany(History::className(), ['user_id' => 'id']);
    }
}
