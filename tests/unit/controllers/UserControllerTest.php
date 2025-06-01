<?php

namespace app\tests\unit\controllers;

use Yii;
use app\controllers\UserController;
use app\models\SignupForm;
use Codeception\Test\Unit;

class UserControllerTest extends Unit
{
    protected $controller;

    protected function _before()
    {
        $this->controller = new UserController('user', Yii::$app);
    }

    public function testActionRegister()
    {
        $model = new SignupForm([
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password_hash' => 'password123',
        ]);

        $user = $model->signup();

        $this->assertInstanceOf('app\models\User', $user, 'Возвращен должен быть объект User');
        $this->assertEquals('testuser', $user->username, 'Имя пользователя должно совпадать');
        $this->assertEquals('test@example.com', $user->email, 'Email должен совпадать');
        $this->assertNotFalse($user->password_hash, 'Пароль должен быть хеширован');
    }

    public function testActionSignup()
    {
        Yii::$app->user->logout();

        $model = new \app\models\LoginForm();
        $model->username = 'testuser';
        $model->password_hash = 'password123';

        $this->assertTrue($model->load(['LoginForm' => $model->attributes]));

        if (!$model->login()) {
            var_dump($model->getErrors()); // Вывод ошибок валидации
        }

        $this->assertTrue(Yii::$app->user->isGuest === false, 'Пользователь не авторизован.');
    }
}