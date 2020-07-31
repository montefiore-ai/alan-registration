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

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

COPY alan-registration /application
WORKDIR /application

RUN composer install && composer update
RUN php bin/console cache:clear --env=prod
RUN php bin/console cache:warmup --env=prod

RUN chmod -R 777 var/log/