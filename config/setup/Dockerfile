FROM php:7.0-fpm

RUN apt-get update \
    && apt-get install -y libicu-dev \
    && apt-get install -y npm \
    && docker-php-ext-install mysqli pdo pdo_mysql intl

RUN npm install -g bower \
    && npm install -g gulp
