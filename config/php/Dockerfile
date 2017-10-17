FROM php:7.0-fpm

RUN apt-get update -qq \
    && apt-get install libicu-dev -qq \
    && docker-php-ext-install mysqli pdo pdo_mysql intl

COPY ./timezone.ini /usr/local/etc/php/
# COPY ./tuningfork.conf /usr/local/etc/php-fpm.d/
