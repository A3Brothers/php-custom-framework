FROM php:8.2-rc-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    vim \
    unzip

COPY --from=composer:2.5.5 /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install pdo pdo_mysql

COPY composer.json composer.lock /var/www/

RUN composer install --no-scripts --no-autoloader

COPY . /var/www

RUN composer dump-autoload --optimize
