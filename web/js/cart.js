$(document).ready(function() {
    // Функция для обновления содержимого корзины (вызывается после каждого изменения)
    function updateCart() {
        $.get('/cart/view', function(data) {
            $('.cart-container').html(data); // Обновляем содержимое контейнера корзины
        });
    }

    // Функция для обновления счетчика товаров в корзине
    function updateCartCount() {
        $.ajax({
            url: '/cart/count', // Создайте actionCount в CartController (см. ниже)
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('.cart-count').text(response.count); // Обновляем счетчик
                }
            },
            error: function() {
                console.error('Ошибка получения количества товаров в корзине.');
            }
        });
    }

    // Инициализация корзины и счетчика при загрузке страницы
    updateCart();
    updateCartCount();


    // Добавление товара в корзину (перехватываем клик по кнопке "Купить")
    $(document).on('click', '.add-to-cart', function(e) { // Изменен селектор
        e.preventDefault();
        var productId = $(this).data('id'); // Получаем ID из URL
        $.ajax({
            url: '/cart/add?id=' + productId, // Изменен URL
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    updateCart(); // Обновляем содержимое корзины
                    updateCartCount(); // Обновляем счетчик
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('Ошибка добавления товара в корзину.');
            }
        });
    });

    // Удаление товара из корзины
    $(document).on('click', '.remove-from-cart', function(e) {
        e.preventDefault();
        var productId = $(this).data('id');
        $.ajax({
            url: '/cart/remove?id=' + productId,
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    updateCart(); // Обновляем содержимое корзины
                    updateCartCount(); // Обновляем счетчик
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('Ошибка удаления товара из корзины.');
            }
        });
    });

    // Обновление количества товара в корзине (пример с полем ввода)
    $(document).on('change', '.cart-quantity', function() {
        var productId = $(this).data('id');
        var quantity = $(this).val();
        $.ajax({
            url: '/cart/update?id=' + productId + '&quantity=' + quantity,
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    updateCart(); // Обновляем содержимое корзины
                } else {
                    alert(response.message);
                    // Если ошибка, можно вернуть старое значение
                    $(this).val($(this).data('old-value'));
                }
            },
            error: function() {
                alert('Ошибка обновления количества товара.');
                // Если ошибка, можно вернуть старое значение
                $(this).val($(this).data('old-value'));
            }
        });
    });
});