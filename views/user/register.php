<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SignupForm */

$this->title = 'Регистрация';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Muhamad Nauval Azhar">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="This is a login page template based on Bootstrap 5">
    <title>Bootstrap 5 Login Page</title>
</head>

<body>
<section class="h-100">
    <div class="container h-100">
        <div class="row justify-content-sm-center h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <h1 class="fs-4 card-title fw-bold mb-4">Регистрация</h1>
                        <?php $form = ActiveForm::begin(['class' => 'needs-validation', 'method' => 'POST']); ?>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="name"></label>
                                <?= $form->field($model, 'username')->textInput(['autofocus' => 'true']) ?>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="email"></label>
                                <?= $form->field($model, 'email') ?>
                            </div>

                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="password">  </label>
                                <?= $form->field($model, 'password_hash') ?>
                            </div>

                            <div class="align-items-center d-flex">
                                <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary ms-auto']) ?>
                            </div>

                        <?php ActiveForm::end() ?>
                    </div>
                    <div class="card-footer py-3 border-0">
                        <div class="text-center">
                            <?= Html::a('Авторизоваться', ['user/signup'], ['class' => 'text-dark']) ?>
                        </div>
                    </div>

                </div>
                <div class="text-center mt-5 text-muted">
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
