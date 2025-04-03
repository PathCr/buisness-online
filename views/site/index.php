<?php

/** @var yii\web\View $this */



use yii\helpers\Html;
use yii\helpers\Url;

$this->registerCssFile('@web/css/body.css');


$this->title = 'Аптечная сеть';
?>

<section class="pharmacy-info">
    <h1>Добро пожаловать в <?= Html::encode($this->title) ?></h1>
    <p>Мы предлагаем широкий ассортимент лекарственных препаратов и товаров для здоровья по доступным ценам. Наша миссия – забота о вашем здоровье и благополучии.</p>
    <p>У нас работают квалифицированные фармацевты, которые всегда готовы проконсультировать вас по любым вопросам, связанным с выбором и применением лекарственных препаратов.</p>

    <!-- Секция с преимуществами -->
    <div class="row advantages">
        <div class="col-md-4">
            <i class="bi bi-check-circle-fill"></i> Широкий ассортимент
        </div>
        <div class="col-md-4">
            <i class="bi bi-hand-thumbs-up-fill"></i> Доступные цены
        </div>
        <div class="col-md-4">
            <i class="bi bi-person-fill-gear"></i> Квалифицированные консультации
        </div>
    </div>
</section>

<!-- Секция с популярными товарами -->
<section class="popular-products">
    <h2>Популярные товары</h2>
    <div class="row">
        <?php
        // В этом месте будет код для вывода популярных товаров из базы данных
        // Пример:
        ?>
        <div class="col-md-3">
            <div class="product-card">
                <img src="" alt="Product 1">
                <h3>Название товара 1</h3>
                <p>Краткое описание товара 1</p>
                <p>Цена: 100 руб.</p>
                <?= Html::a('Купить', '#', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="product-card">
                <img src="" alt="Product 2">
                <h3>Название товара 2</h3>
                <p>Краткое описание товара 2</p>
                <p>Цена: 150 руб.</p>
                <?= Html::a('Купить', '#', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="product-card">
                <img src="" alt="Product 3">
                <h3>Название товара 3</h3>
                <p>Краткое описание товара 3</p>
                <p>Цена: 200 руб.</p>
                <?= Html::a('Купить', '#', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="product-card">
                <img src="" alt="Product 4">
                <h3>Название товара 4</h3>
                <p>Краткое описание товара 4</p>
                <p>Цена: 250 руб.</p>
                <?= Html::a('Купить', '#', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
</section>

<!-- Секция "Наши аптеки" с картой и списком адресов -->
<section class="pharmacy-locations">
    <h2>Наши аптеки</h2>
    <div class="row">
        <div class="col-md-6">
            <!-- Здесь будет карта (например, Google Maps) -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d21449.400133629056!2d38.93757844597556!3d45.03547900262022!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40f04435b0375113%3A0x52571155a98ca8a1!2z0JrRg9C30L3QsNC90LjRhtCw!5e0!3m2!1sru!2s!4v1701158730395!5m2!1sru!2s" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="col-md-6">
            <h3>Адреса наших аптек:</h3>
            <ul>
                <li>ул. Ленина, д. 5</li>
                <li>пр. Центральный, д. 10</li>
                <li>ул. Новая, д. 25</li>
            </ul>
        </div>
    </div>
</section>


