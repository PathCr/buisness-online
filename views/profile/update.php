<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Редактирование профиля';
?>

<div class="profile-update">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Редактирование профиля</h4>
                    </div>
                    <div class="card-body">
                        <?php $form = ActiveForm::begin(); ?>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($user, 'username')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($user, 'first_name')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($user, 'last_name')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Отмена', ['view'], ['class' => 'btn btn-outline-secondary ms-2']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>