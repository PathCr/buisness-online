$(document).ready(function() {

    $(document).on('click', '.cart-icon', function(e) {
        e.preventDefault();
        console.log('Корзина нажата'); // Отладочное сообщение
        $.get('/cart/get-cart', function(data) {
            console.log(data); // Отладочное сообщение
            if (data.success) {
                $('.cart-container').html('');
                data.cart.forEach(function(item) {
                    console.log(item); // Отладочное сообщение для каждого элемента
                    if (item.product && item.product.name) {
                        $('.cart-container').append('<li>' + item.product.name + ' - ' + item.quantity + ' x ' + item.product.price + ' руб.</li>');
                    } else {
                        console.error('Product data is missing:', item);
                    }
                });
                $('#cart-total').text(data.total);
                $('#cart-modal').show(); // Показываем модальное окно
            } else {
                alert(data.message);
            }
        });
    });

    // Закрытие модального окна
    $(document).on('click', '.close', function() {
        $('#cart-modal').hide();
    });

    // Закрытие модального окна при клике вне его
    $(window).on('click', function(event) {
        if ($(event.target).is('#cart-modal')) {
            $('#cart-modal').hide();
        }
    });

    // Функция для обновления содержимого корзины (вызывается после каждого изменения)
    function updateCart() {
        $.get('/cart/view', function(data) {
            $('.cart-container').html(data); // Обновляем содержимое контейнера корзины
        });
    }

    // Функция для обновления счетчика товаров в корзине
    function updateCartCount() {
        $.ajax({
            url: '/cart/count',
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
    $(document).on('click', '.add-to-cart', function(e) {
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

    // Обновление количества товара в корзине
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