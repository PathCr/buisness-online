<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCssFile('//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
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

    <?php $this->registerJsFile("//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js", ) ?>
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
                <a class="navbar-brand" rel="nofollow" target="_blank" href="#" style="text-transform: uppercase;"> Аптечная сеть</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">

                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item active">
                            <?= Html::a('Главная', ['site/index'], ['class' => 'nav-link']) ?>
                        </li>

                        <li class="nav-item">
                                <a class="nav-link" href="#">О нас</a>
                        </li>

                        <li class="nav-item">
                            <?= Html::a('Медикаменты', ['site/search'], ['class' => 'nav-link']) ?>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Контакты</a>
                        </li>

                        <li class="nav-item">
                            <?= Html::a('Регистрация', ['site/signup'], ['class' => 'nav-link']) ?>
                        </li>
                    </ul>
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
        <p class="float-end">
            <?php
             echo Html::a('About', ['/about'], ['class' => 'text-white']);
             echo ' | ';
             echo Html::a('Contact', ['/contact'], ['class' => 'text-white']);
            ?>
        </p>
    </div>
</footer>
<style>
    .footer a {
        color: white;
        text-decoration: none;
    }

    .footer a:hover {
        text-decoration: underline;
    }
</style>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
