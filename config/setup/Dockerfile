FROM php:7.0-fpm

RUN apt-get update \
    && apt-get install -qq libicu-dev \
    && apt-get install -qq npm \
    && apt-get install -qq git \
    && docker-php-ext-install mysqli pdo pdo_mysql intl

RUN npm install -g bower \
    && npm install -g gulp
