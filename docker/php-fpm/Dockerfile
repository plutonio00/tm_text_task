FROM php:8.2-fpm

RUN apt-get update

RUN apt-get install -y git zip libpq-dev
RUN docker-php-ext-install pdo pdo_pgsql && docker-php-ext-enable pdo_pgsql

RUN pecl install xdebug && docker-php-ext-enable xdebug
COPY ./config/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

#RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/bin/composer

WORKDIR /var/www/fuzzy_logic