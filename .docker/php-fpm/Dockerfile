FROM php:7.4-fpm
COPY wait-for-it.sh /usr/bin/wait-for-it
RUN chmod +x /usr/bin/wait-for-it
RUN apt-get update && apt-get install -y --no-install-recommends openssh-server git zlib1g-dev libxml2-dev libzip-dev libxslt-dev
RUN docker-php-ext-install zip xsl intl pdo pdo_mysql
COPY --from=composer /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
CMD mkdir /var/www/.ssh ; mkdir /var/www/keys ; chown -R www-data: /var/www/keys ; chown -R www-data: /var/www/alan-config ; chown -R www-data: /var/www/keys ; cp /var/www/.env /var/www/.env.local ; composer install ; wait-for-it database:3306 -- bin/console doctrine:schema:create ; php-fpm
EXPOSE 9000
