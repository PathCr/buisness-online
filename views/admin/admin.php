<?php

/**
 * @var yii\web\View $this
 */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Админка';

/**
 * @var yii\bootstrap5\ActiveForm $model
 * @var app\models\User $users
 */

?>

<div class="container d-flex justify-content-center">
    <div class="text-center">
        <div class="admin-info">
            <br>
            <p>ID администратора: <?= Html::encode(Yii::$app->user->id) ?></p>
            <p>Администратор: <?= Html::encode(Yii::$app->user->identity->first_name . ' ' . Yii::$app->user->identity->last_name) ?></p>
        </div>

        <div class="form-group">
            <?= Html::a('Выгрузить в Excel (все пользователи)', ['export/export-opros'], ['class' => 'btn btn-primary']) ?>
        </div>

        <h3>Выберите пользователя для экспорта</h3>
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'id')->dropDownList($users, ['prompt' => 'Выберите пользователя'])->label(false) ?>
        <div class="form-group">
            <?= Html::submitButton('Выгрузить в Excel (один пользователь)', ['class' => 'btn btn-secondary', 'name' => 'export-user']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
