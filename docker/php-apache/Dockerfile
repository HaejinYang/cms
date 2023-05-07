FROM php:8.2-apache

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"