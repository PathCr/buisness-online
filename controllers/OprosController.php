<?php

namespace app\controllers;

use app\assets\AboutUsAsset;
use Yii;
use app\models\Opros;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

class OprosController extends Controller
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
                'denyCallback' => function ($rule, $action) {
                    throw new ForbiddenHttpException('Доступ запрещен. Необходимо авторизоваться.');
                }
            ],
        ];
    }

    public function actionCreate()
    {
        AboutUsAsset::register($this->view);

        if (Opros::find()->where(['user_id' => Yii::$app->user->id])->exists()) {
            Yii::$app->session->setFlash('warning', 'Вы уже проходили этот опрос.');
            return $this->goBack(); // Перенаправляем на главную страницу или куда-то еще
        }

        $model = new Opros();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;

            Yii::debug($model->attributes, 'opros_data');

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Спасибо за участие в опросе!');
                return $this->goBack();
            } else {
                Yii::error($model->errors, 'opros');
                Yii::$app->session->setFlash('error', 'Произошла ошибка при сохранении данных.');
            }
        }

        return $this->render('opros', [
            'model' => $model,
        ]);
    }
}