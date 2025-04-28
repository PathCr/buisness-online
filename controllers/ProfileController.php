<?php

namespace app\controllers;

use app\assets\AboutUsAsset;
use app\assets\ProfileAsset;
use app\assets\UpdateAsset;
use Yii;
use app\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionView()
    {
        ProfileAsset::register($this->view);

        $user = User::findOne(Yii::$app->user->id);

        return $this->render('profile', [
            'user' => $user
        ]);
    }

    public function actionUpdate()
    {
        UpdateAsset::register($this->view);

        $user = User::findOne(Yii::$app->user->id);
        
        if (!$user) {
            throw new NotFoundHttpException('Пользователь не найден.');
        }

        if ($user->load(Yii::$app->request->post()) && $user->save()) {
            Yii::$app->session->setFlash('success', 'Профиль успешно обновлен.');
            return $this->goBack();
        }

        return $this->render('update', [
            'user' => $user,
        ]);
    }
}