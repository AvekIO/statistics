FROM php:8.1-fpm

RUN apt-get update \
    && apt-get upgrade -yq \
    && apt-get install -yq apt-utils \
    && apt-get install -yq git vim iproute2 \
    && pecl install -o -f redis \
    && docker-php-ext-install pdo \
    && docker-php-ext-install pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
