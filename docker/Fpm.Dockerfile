FROM php:7.4-fpm

RUN apt-get update \
    && docker-php-ext-install pdo pdo_mysql
RUN chown -R www-data:www-data /var/www/