<?php

namespace app\components;

use Yii;
use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;

class AccessControl extends ActionFilter
{
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        $controller = $action->controller;
        $permission = $controller->id . '/' . $action->id;

        if (Yii::$app->user->can($permission)) {
            return true;
        }

    }
} 