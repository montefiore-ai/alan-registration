FROM php:7.4-fpm
RUN apk --update --no-cache add git
RUN apt-get update && apt-get install y && apt-get install -y --no-install-recommends git zlib1g-dev libxml2-dev libzip-dev libxslt-dev
RUN docker-php-ext-install zip xsl intl pdo pdo_mysql
COPY --from=composer /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
CMD composer install ; php-fpm
EXPOSE 9000
