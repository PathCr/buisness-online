<?php

namespace app\commands;

use Yii;
use app\models\User;
use yii\console\Controller;

class UserController extends Controller
{
    /**
     * Создает нового пользователя с ролью admin
     * @param string $username Логин админа
     * @param string $password_hash Пароль
     * @param string $email почта
     */

    public function actionSetToAdmin(string $username, string $password_hash, string $email)
    {
        User::setAdmin($username, $password_hash, $email);

    }

    public function actionGet()
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();
        var_dump($auth);
//        print_r($roles);
    }
}