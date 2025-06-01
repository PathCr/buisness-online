<?php

use yii\helpers\Html;

?>

<div class="cart-container">
    <?php if (isset($cart) && !empty($cart)): ?>
        <ul>
            <?php foreach ($cart as $item): ?>
                <li>
                    <span class="cart-count"><?= $this->context->getCartCount() ?></span>
                    <?= Html::encode($item->product->name) ?> - <?= $item->quantity ?> x <?= $item->price ?> руб.
                    <a href="#" class="remove-from-cart" data-id="<?= $item->product_id ?>">Удалить</a>
                </li>
            <?php endforeach; ?>
        </ul>
        <p>Итого: <?= $total ?></p>
    <?php else: ?>
        <p>Корзина пуста.</p>
    <?php endif; ?>
</div>
