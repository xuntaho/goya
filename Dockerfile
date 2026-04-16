FROM php:8.2-apache

# Cài package cần thiết
RUN apt-get update && apt-get install -y \
    unzip curl git libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql

# Copy project
COPY . /var/www/html/
WORKDIR /var/www/html

# Cài composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Laravel
RUN composer install --no-dev --optimize-autoloader

# Tạo key + cache config
RUN cp .env.example .env || true
RUN php artisan key:generate || true
RUN php artisan config:cache || true

# Quyền
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 storage bootstrap/cache

# Apache config
RUN a2enmod rewrite
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

CMD ["apache2-foreground"]