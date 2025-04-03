<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $password_hash;
    public $email;

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['username', 'password_hash', 'email'], 'required', 'message' => 'Поле "Имя" обязательно для заполнения.'],
            [['username', 'password_hash', 'email'], 'trim'],

            ['username', 'string', 'min' => 2, 'max' => 255],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This username has already been taken.'],

            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This email has already been taken.'],

            ['password_hash', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'email' => 'Почта',
            'password_hash' => 'Пароль'
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password_hash);
        $user->generateAuthKey();
        $user->created_at = time();
        $user->updated_at = time();
        $user->role = 'customer';

        return $user->save() ? $user : null;
    }
}