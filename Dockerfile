FROM php:8.2-apache

RUN docker-php-ext-install mysqli && a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock /var/www/html/
RUN composer install --no-dev --no-scripts --no-autoloader

COPY . /var/www/html
RUN composer dump-autoload --optimize --no-dev

RUN chown -R www-data:www-data /var/www/html/writable \
    && sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
