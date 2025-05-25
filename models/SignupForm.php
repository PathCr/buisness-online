<?php

namespace app\models;

use Yii;
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
            ['username', 'trim'],
            [['username'], 'required', 'message' => 'Обязательно для заполнения'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Это имя пользователя уже занято.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            [['email'], 'required', 'message' => 'Обязательно для заполнения'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Этот email уже занят.'],

            [['password_hash'], 'required', 'message' => 'Обязательно для заполнения'   ],
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
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password_hash);
        $user->generateAuthKey();
        $user->created_at = time();
        $user->updated_at = time();

        if ($user->save()) {
            $auth = Yii::$app->authManager;
            $role = $auth->getRole('user');
            $auth->assign($role, $user->id);
            $assignedRoles = $auth->getRolesByUser($user->id);
            print_r($assignedRoles); // Вывод всех ролей пользователя
            return $user;
        }

        return null;
    }
}