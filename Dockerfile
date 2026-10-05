FROM php:8.2-fpm

# Sistem bağımlılıkları
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip nginx

# PHP eklentileri
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Composer kurulumu
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

# Dosya izinleri
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Başlatma komutları
EXPOSE 80
CMD php artisan migrate --force && php artisan config:cache && php artisan route:cache && php artisan view:cache && php -S 0.0.0.0:80 -t public