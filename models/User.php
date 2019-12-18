<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property mixed $authKey
 * @property mixed auth_key
 * @property int id
 * @property string email
 * @property string password
 * @property string first_name
 * @property string last_name
 * @property int role
 * @property float rating
 */
class User extends ActiveRecord implements IdentityInterface
{
	const ROLE_ADMINISTRATOR = 1;
	const ROLE_USER = 0;

	public static function tableName()
	{
		return 'user';
	}

	/**
	 * {@inheritdoc}
	 */
	public static function findIdentity($id)
	{
		return static::findOne($id);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		//return static::findOne(['access_token' => $token]);
	}

	/**
	 * Finds user by username
	 *
	 * @param string $username
	 * @return static|null
	 */
	public static function findByUsername($username)
	{
		return static::findOne(['username' => $username]);
	}

	/**
	 * Finds user by email
	 *
	 * @param string $email
	 * @return static|null
	 */
	public static function findByEmail($email)
	{
		return static::findOne(['email' => $email]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAuthKey()
	{
		return $this->auth_key;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getRole()
	{
		return $this->role;
	}

	/**
	 * {@inheritdoc}
	 */
	public function validateAuthKey($authKey)
	{
		return $this->auth_key === $authKey;
	}

	/**
	 * Validates password
	 *
	 * @param string $password password to validate
	 * @return bool if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
//        return $this->password === $password;
		return \Yii::$app->security->validatePassword($password, $this->password);
	}

	public function generateAuthKey()
	{
		$this->auth_key = \Yii::$app->security->generateRandomString();
	}
}