<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Авторизация';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Muhamad Nauval Azhar">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="This is a login page template based on Bootstrap 5">
<!--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">-->
</head>

<body>
<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-sm-center h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <h1 class="fs-4 card-title fw-bold mb-4">Авторизация</h1>
                        <?php $form = ActiveForm::begin(['class' => 'needs-validation', 'method' => 'POST']); ?>
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="username"></label>
                                <?= $form->field($model, 'username')->textInput(['autofocus' => 'true']) ?>
                            </div>

                            <div class="mb-3">
                                <div class="mb-2 w-100">
                                    <?= Html::a('Забыл пароль', 'user/forgot', ['class' => 'float-end']) ?>
                                </div>
                                <?= $form->field($model, 'password_hash') ?>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="form-check">
                                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                    <label for="remember" class="form-check-label">Запомнить меня</label>
                                </div>
                                    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary ms-auto']) ?>
                            </div>
                            <?php ActiveForm::end() ?>
                    </div>
                    <div class="card-footer py-3 border-0">
                        <div class="text-center">
                            Нет аккаунта? <?= Html::a('Создать', ['user/register'], ['class' => 'text-dark']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="js/login.js"></script>
</body>
</html>
