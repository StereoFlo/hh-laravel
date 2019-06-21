FROM php:7.2-fpm

RUN apt-get update && apt-get install -y \
            curl \
            wget \
            libfreetype6-dev \
            libjpeg62-turbo-dev \
            libmcrypt-dev \
            && docker-php-ext-install mysqli pdo_mysql iconv zip
