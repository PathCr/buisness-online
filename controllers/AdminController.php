<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\User;

class AdminController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actionView()
    {
        $users = User::find()->all();
        $userList = [];

        foreach ($users as $user) {
            $userList[$user->id] = $user->username . ' (ID: ' . $user->id . ')';
        }

        if (Yii::$app->request->isPost && isset($_POST['export-user'])) {
            $userId = Yii::$app->request->post('User')['id'];

            return $this->redirect(['export/export-user', 'id' => $userId]);
        }

        return $this->render('admin', [
            'users' => $userList,
            'model' => new User(),
        ]);
    }
}