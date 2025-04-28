<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Профиль пользователя';
?>

<div class="profile-view">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card profile-card">
                    <div class="card-body text-center">
                        <div class="profile-avatar">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <h3 class="profile-name"><?= Html::encode($user->first_name . ' ' . $user->last_name) ?></h3>
                        <p class="text-muted">@<?= Html::encode($user->username) ?></p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Информация о профиле</h4>
                    </div>
                    <div class="card-body">
                        <div class="profile-info">
                            <div class="info-item">
                                <span class="info-label">Имя пользователя:</span>
                                <span class="info-value"><?= Html::encode($user->username) ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Email:</span>
                                <span class="info-value"><?= Html::encode($user->email) ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Имя:</span>
                                <span class="info-value"><?= Html::encode($user->first_name) ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Фамилия:</span>
                                <span class="info-value"><?= Html::encode($user->last_name) ?></span>
                            </div>
                        </div>
                        
                        <div class="profile-actions mt-4">
                            <?= Html::a('Редактировать профиль', ['update'], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a('Изменить пароль', ['change-password'], ['class' => 'btn btn-outline-secondary ms-2']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>