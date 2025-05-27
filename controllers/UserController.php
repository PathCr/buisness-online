<?php

namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\SignupForm;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['register', 'signup', 'login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
                'denyCallback' => function () {
                    throw new ForbiddenHttpException('Доступ запрещен');
                }
            ],
        ];
    }

    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if($model->load(Yii::$app->request->post()) && $model->login())
        {
            Yii::$app->session->setFlash('success', 'Спасибо за авторизацию!');
            return $this->goBack();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->signup()) {
                Yii::$app->session->setFlash('success', 'Спасибо за регистрацию!');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Не удалось зарегистрировать пользователя.');
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionForgot()
    {
        return $this->render('forgot');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}