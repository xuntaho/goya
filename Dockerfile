FROM php:8.2-apache

# Cài extension cần thiết
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    git \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql

# Copy code
COPY . /var/www/html/

WORKDIR /var/www/html

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Laravel
RUN composer install --no-dev --optimize-autoloader

# Quyền
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Apache config
RUN a2enmod rewrite
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

CMD ["apache2-foreground"]