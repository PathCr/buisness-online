<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\OprosOptions;

/* @var $this yii\web\View */
/* @var $model app\models\OprosOptions */

$this->title = 'Пройти опрос';

$this->registerCss("
    .survey-create {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .survey-create h1 {
        text-align: center;
        color: #333;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        font-weight: bold;
    }
    .btn-success {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        color: white;
        cursor: pointer;
    }
    .form-control {
        border-radius: 4px;
        border: 1px solid #ccc;
        padding: 8px;
        width: 100%;
    }
");
?>
<div class="survey-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'question1')->dropDownList(
        OprosOptions::getOptionsForQuestion(1), // 1 - ID вопроса "Как часто посещаете аптеки?"
        ['prompt' => 'Выберите вариант']
    ) ?>

    <?= $form->field($model, 'question2')->dropDownList(
        OprosOptions::getOptionsForQuestion(2), // 2 - ID вопроса "Как часто употребляете пиво?"
        ['prompt' => 'Выберите вариант']
    ) ?>

    <?= $form->field($model, 'question3')->dropDownList(
        OprosOptions::getOptionsForQuestion(3), // 3 - ID вопроса "Считаете ли вы употребление пива вредным для здоровья?"
        ['prompt' => 'Выберите вариант']
    ) ?>

    <?= $form->field($model, 'question4')->dropDownList(
        OprosOptions::getOptionsForQuestion(4), // 4 - ID вопроса "Какие меры принимаете от похмелья?"
        ['prompt' => 'Выберите вариант']
    ) ?>

    <?= $form->field($model, 'question5')->textarea(['rows' => 3])->label('Какие средства от похмелья вы обычно покупаете?') ?>

    <?= $form->field($model, 'question6')->dropDownList(
        OprosOptions::getOptionsForQuestion(6), // 6 - ID вопроса "Где покупаете средства от похмелья?"
        ['prompt' => 'Выберите вариант']
    ) ?>

    <?= $form->field($model, 'question8')->dropDownList(
        OprosOptions::getOptionsForQuestion(8), // 8 - ID вопроса "Готовы ли вы получать консультации?"
        ['prompt' => 'Выберите вариант']
    ) ?>

    <?= $form->field($model, 'question9')->dropDownList(
        OprosOptions::getOptionsForQuestion(9), // 9 - ID вопроса "Насколько доверяете информации?"
        ['prompt' => 'Выберите вариант']
    ) ?>

    <?= $form->field($model, 'question10')->dropDownList(
        OprosOptions::getOptionsForQuestion(10), // 10 - ID вопроса "Уместно ли продавать в аптеке товары?"
        ['prompt' => 'Выберите вариант']
    ) ?>

    <?= $form->field($model, 'gender')->dropDownList([
        'Мужской' => 'Мужской',
        'Женский' => 'Женский',
    ], ['prompt' => 'Выберите пол']) ?>

    <?= $form->field($model, 'age')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>