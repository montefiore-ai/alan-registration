FROM php:7.4-fpm

RUN apt-get update && apt-get install -y

RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    zlib1g-dev \
    libxml2-dev \
    libzip-dev \
    libxslt-dev \
    && docker-php-ext-install \
    zip \
    xsl \
    intl \
    pdo pdo_mysql