<?php

namespace app\models;

use PHPUnit\Util\Exception;
use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $role
 * @property string $first_name
 * @property string $last_name
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'first_name', 'last_name'], 'required'],
            [['username', 'email', 'first_name', 'last_name'], 'trim'],
            [['username', 'email'], 'string', 'max' => 191],
            [['first_name', 'last_name'], 'string', 'max' => 255],
            ['email', 'email'],
            ['email', 'unique', 'message' => 'Этот email уже занят.'],
            ['username', 'unique', 'message' => 'Это имя пользователя уже занято.'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new Exception('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
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
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password_hash password to validate
     * @return bool whether password provided is valid
     */
    public function validatePassword($password_hash)
    {
        return Yii::$app->security->validatePassword($password_hash, $this->password_hash);
    }

    /**
     * Generates password hash from password
     *
     * @param string $password_hash
     * @throws \yii\base\Exception
     */
    public function setPassword($password_hash)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password_hash);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates email verification token
     */
    public function generateEmailVerificationToken()
    {
        $this->email_verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Finds user by email verification token
     *
     * @param string $token email verification token
     * @return static|null
     */
    public static function findByVerificationToken(string $token): ?User
    {
        return static::findOne([
            'email_verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Validate email verification token
     *
     * @param string $token email verification token
     * @return bool
     */
    public function validateEmailVerificationToken(string $token): bool
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.verifyEmailTokenExpire'];

        return $timestamp + $expire >= time();
    }

    /**
     * Verify email token
     *
     * @param string $token email verification token
     * @return bool
     */
    public function verifyEmail(string $token): bool
    {
        if (!$this->validateEmailVerificationToken($token)) {
            return false;
        }

        $this->status = self::STATUS_ACTIVE;
        $this->email_verification_token = null;

        return $this->save(false);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'email' => 'Email',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'password_hash' => 'Пароль',
        ];
    }
}