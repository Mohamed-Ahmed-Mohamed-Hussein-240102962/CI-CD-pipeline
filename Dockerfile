FROM php:8.3-fpm

WORKDIR /var/www/html

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN apt-get update \
    && apt-get install -y unzip libzip-dev \
    && docker-php-ext-install pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

COPY ./src/composer.json ./src/composer.lock ./
RUN composer install --no-dev --no-interaction --no-scripts --no-autoloader

COPY ./src .
RUN composer dump-autoload --optimize  \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache
