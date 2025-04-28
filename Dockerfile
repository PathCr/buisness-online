# Используем официальный образ PHP с Apache
FROM php:8.0-apache

# Устанавливаем необходимые расширения PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install -j$(nproc) pdo_mysql \
    && docker-php-ext-install -j$(nproc) mbstring \
    && docker-php-ext-install -j$(nproc) intl

# Дополнительные расширения (если нужны)
RUN apt-get update && apt-get install -y libzip-dev
RUN docker-php-ext-install zip

# Устанавливаем composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Копируем файлы приложения в контейнер
COPY . /var/www/html/

# Устанавливаем права доступа (если необходимо)
RUN chown -R www-data:www-data /var/www/html/

# Меняем текущего пользователя на www-data
USER www-data

# Устанавливаем права на папку runtime
RUN chmod -R 777 /var/www/html/runtime
RUN chmod -R 777 /var/www/html/web/assets

# Устанавливаем переменные окружения
ENV YII_ENV dev
ENV YII_DEBUG true

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Запускаем composer install
RUN composer install --ignore-platform-reqs --no-interaction --no-plugins --no-scripts

# (Опционально) Выставляем порт 80
EXPOSE 80