<?php

namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\SignupForm;
use yii\web\Controller;

class UserController extends Controller
{

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
        if ($model->load(Yii::$app->request->post()) && $model->signup())
        {
            Yii::$app->session->setFlash('success', 'Спасибо за регистрацию!');
            return $this->goHome();
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionForgot()
    {
        return $this->render('forgot');
    }
}