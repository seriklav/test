<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "session".
 *
 * @property int $session_id
 * @property string|null $id
 * @property resource|null $data
 * @property int|null $user_id
 * @property int|null $expire
 * @property string|null $last_activity
 * @property string|null $last_ip
 *
 * @property User $user
 */
class Session extends \yii\db\ActiveRecord
{
	public $first_name;
	public $last_name;
	public $email;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'session';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data'], 'string'],
            [['user_id', 'expire'], 'integer'],
            [['last_activity'], 'safe'],
            [['id'], 'string', 'max' => 40],
            [['last_ip'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
	        'user_id' => 'Номер користувача',
	        'first_name' => 'Імя',
	        'last_name' => 'Фамілія',
	        'email' => 'Email',
            'last_activity' => 'Остання активність',
            'last_ip' => 'IP адресса',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
