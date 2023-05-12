FROM php:8.2-apache

RUN apt-get update && apt-get -y install \
    net-tools iputils-ping telnet

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"