<?php

use yii\db\Migration;
use yii\rbac\DbManager;

class m250522_063630_create_basic_roles extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;  //  Используйте компонент authManager

        if (!$auth) {
            echo "Error: Auth manager not found. Check your configuration.\n";
            return false; // Прерываем миграцию, если authManager не настроен
        }

        // Создаем роли
        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        if (!$auth->add($admin)) {
            echo "Error creating 'admin' role.\n";
        }

        $manager = $auth->createRole('manager');
        $manager->description = 'Менеджер';
        if (!$auth->add($manager)) {
            echo "Error creating 'manager' role.\n";
        }

        $user = $auth->createRole('user');
        $user->description = 'Пользователь';
        if (!$auth->add($user)) {
            echo "Error creating 'user' role.\n";
        }

        // Создаем разрешения
        $viewAdminPanel = $auth->createPermission('viewAdminPanel');
        $viewAdminPanel->description = 'Доступ к панели администратора';
        if (!$auth->add($viewAdminPanel)) {
            echo "Error creating 'viewAdminPanel' permission.\n";
        }

        $manageUsers = $auth->createPermission('manageUsers');
        $manageUsers->description = 'Управление пользователями';
        if (!$auth->add($manageUsers)) {
            echo "Error creating 'manageUsers' permission.\n";
        }

        $manageProducts = $auth->createPermission('manageProducts');
        $manageProducts->description = 'Управление товарами';
        if (!$auth->add($manageProducts)) {
            echo "Error creating 'manageProducts' permission.\n";
        }

        // Назначаем разрешения ролям
        if (!$auth->addChild($admin, $viewAdminPanel)) {
            echo "Error assigning 'viewAdminPanel' to 'admin'.\n";
        }
        if (!$auth->addChild($admin, $manageUsers)) {
            echo "Error assigning 'manageUsers' to 'admin'.\n";
        }
        if (!$auth->addChild($admin, $manageProducts)) {
            echo "Error assigning 'manageProducts' to 'admin'.\n";
        }

        if (!$auth->addChild($manager, $viewAdminPanel)) {
            echo "Error assigning 'viewAdminPanel' to 'manager'.\n";
        }
        if (!$auth->addChild($manager, $manageProducts)) {
            echo "Error assigning 'manageProducts' to 'manager'.\n";
        }
    }

    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        if (!$auth) {
            echo "Error: Auth manager not found. Check your configuration.\n";
            return false; // Прерываем миграцию, если authManager не настроен
        }
        // Удаляем все роли и разрешения.  Будьте осторожны!
        if (!$auth->removeAll()) {
            echo "Error removing all roles and permissions.\n";
        }
    }
} 