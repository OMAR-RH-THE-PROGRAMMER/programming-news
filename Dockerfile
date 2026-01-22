FROM php:8.2-apache

# Retry عشان الـ EOF لو حصل
RUN apt-get update --fix-missing && \
    apt-get install -y git curl libpng-dev libonig-dev libxml2-dev zip unzip || \
    (sleep 20 && apt-get update --fix-missing && apt-get install -y git curl libpng-dev libonig-dev libxml2-dev zip unzip)

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Composer داخلي
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN a2enmod rewrite

WORKDIR /var/www/html

COPY . /var/www/html

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]