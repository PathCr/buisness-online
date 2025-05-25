<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;

class ExportController extends Controller
{

    public function actionExportOpros()
    {
        if (!Yii::$app->user->can('admin')) {
            throw new \yii\web\ForbiddenHttpException('Доступ запрещен.');
        }
    }

}