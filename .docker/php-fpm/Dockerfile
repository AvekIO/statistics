FROM php:8.1-fpm

RUN apt-get update \
    && apt-get upgrade -yq \
    && apt-get install -yq apt-utils \
    && apt-get install -yq git vim iproute2 \
    && apt-get install -yq librabbitmq-dev \
    && apt-get install -yq percona-toolkit \
    && apt-get install -yq mc \
    && pecl install -o -f redis \
    && pecl install amqp-1.11.0 \
    && docker-php-ext-install pdo \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-enable amqp \
    && docker-php-ext-install sockets

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
