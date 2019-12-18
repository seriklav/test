<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property int|null $role
 * @property float|null $rating
 * @property string|null $created_at
 * @property string|null $update_at
 *
 * @property History[] $histories
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
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
	        [['email', 'password', 'first_name', 'last_name'], 'required'],
	        [['role'], 'integer'],
	        [['rating'], 'number'],
	        [['email', 'password', 'first_name', 'last_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ Пользователя',
            'email' => 'Email',
            'password' => 'Пароль',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'role' => 'Тип',
            'rating' => 'Балы',
            'created_at' => 'Дата добавления',
            'update_at' => 'Дата изменения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistories()
    {
        return $this->hasMany(History::className(), ['user_id' => 'id']);
    }

	/**
	 * @inheritDoc
	 */
	public static function findIdentity($id)
	{
		// TODO: Implement findIdentity() method.
	}

	/**
	 * @inheritDoc
	 */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		// TODO: Implement findIdentityByAccessToken() method.
	}

	/**
	 * @inheritDoc
	 */
	public function getId()
	{
		// TODO: Implement getId() method.
	}

	/**
	 * @inheritDoc
	 */
	public function getAuthKey()
	{
		// TODO: Implement getAuthKey() method.
	}

	/**
	 * @inheritDoc
	 */
	public function validateAuthKey($authKey)
	{
		// TODO: Implement validateAuthKey() method.
	}
}
