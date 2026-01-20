FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --optimize-autoloader --no-dev --no-interaction

# أنشئ .env أساسي (بدون copy من example، عشان مستقل)
RUN touch .env
RUN echo "APP_NAME='Programming News'" >> .env
RUN echo "APP_ENV=local" >> .env
RUN echo "APP_DEBUG=true" >> .env
RUN echo "APP_URL=http://localhost:8000" >> .env
RUN echo "DB_CONNECTION=sqlite" >> .env  # اختياري، لو مفيش DB حقيقي

# توليد الـ encryption key (أهم حاجة عشان ميطلعش 500 error)
RUN php artisan key:generate --force --no-interaction

# صلاحيات Laravel
RUN chmod -R 777 storage bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]