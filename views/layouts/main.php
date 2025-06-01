<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\helpers\Url;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

AppAsset::register($this);

$this->registerCssFile('//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
//$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js');
$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">

    <?php $this->registerJsFile("//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js") ?>

    <!-- Navigation -->
    <div class="fixed-top">
        <header class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="social-network">
                            <li><a class="waves-effect waves-dark" href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="waves-effect waves-dark" href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="waves-effect waves-dark" href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a class="waves-effect waves-dark" href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li><a class="waves-effect waves-dark" href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <nav class="navbar navbar-expand-lg navbar-dark mx-background-top-linear">
            <div class="container">
                <?= Html::a('Аптечная сеть', ['site/index'], ['class' => 'navbar-brand', 'style' => 'text-transform: uppercase;']) ?>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <?php $form = ActiveForm::begin(['action' => ['user/logout'], 'method' => 'post', 'options' => ['class' => 'navbar-nav ml-auto']]); ?>
                        <li class="nav-item active">
                            <?= Html::a('Главная', ['site/index'], ['class' => 'nav-link']) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a('О нас', ['site/about'], ['class' => 'nav-link']) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a('Медикаменты', ['search/search'], ['class' => 'nav-link']) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a('Контакты', ['contact/contact'], ['class' => 'nav-link', 'data-method' => 'post']) ?>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button">
                                Меню
                            </a>
                            <ul class="dropdown-menu">
                                <?php if (!Yii::$app->user->isGuest): ?>
                                    <li><?= Html::a('Корзина', ['cart/view'], ['class' => 'dropdown-item', 'data-method' => 'post']) ?></li>
                                    <li><?= Html::a('Профиль', ['profile/view'], ['class' => 'dropdown-item']) ?></li>
                                <?php endif; ?>
                                <li><?= Html::a('Опрос', ['opros/create'], ['class' => 'dropdown-item']) ?></li>
                                <?php if (Yii::$app->user->isGuest): ?>
                                    <li><?= Html::a('Вход', ['user/register'], ['class' => 'dropdown-item']) ?></li>
                                <?php else: ?>
                                    <li><?= Html::submitButton('Выход', ['class' => 'dropdown-item']) ?></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php if (Yii::$app->user->can('admin')): ?>
                            <li class="nav-item">
                                <?= Html::a('Админка', ['admin/view'], ['class' => 'nav-link', 'data-method' => 'post']) ?>
                            </li>
                        <?php endif; ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </nav>
    </div>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light" style="background-color: #54d400; color: white; padding: 20px; text-align: center;">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
    </div>
</footer>
<?php
    $this->registerJsFile(
            Url::to('js/cart.js'),
        ['depends' => [\yii\web\JqueryAsset::class]],
    );
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
