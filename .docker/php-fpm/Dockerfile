FROM php:7.4-fpm
RUN apt-get update && apt-get install -y --no-install-recommends git zlib1g-dev libxml2-dev libzip-dev libxslt-dev
RUN docker-php-ext-install zip xsl intl pdo pdo_mysql
COPY --from=composer /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
CMD cp /var/www/.env /var/www/.env.local ; composer install ; php-fpm
EXPOSE 9000
