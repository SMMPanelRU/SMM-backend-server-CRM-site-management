FROM php:8.1-fpm

WORKDIR /var/www/html

RUN apt-get update

RUN apt-get update \
    && apt-get install -y \
        zsh \
        git \
        curl \
        zip \
        unzip \
        wget \
        supervisor \
        libzip-dev \
        libpng-dev \
        libmagickwand-dev \
        libcurl4-openssl-dev \
        pkg-config \
        libssl-dev

RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

RUN pecl install \
        redis \
        xdebug \
        imagick \
        zstd \
        zip

RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-install \
        gd \
        pdo \
        pdo_mysql \
        bcmath \
        exif

RUN docker-php-ext-enable \
        redis \
        xdebug \
        imagick \
        zstd \
        bcmath \
        exif \
        zip

RUN ln -sf /bin/bash /bin/sh

EXPOSE 9000

