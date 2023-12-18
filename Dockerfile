FROM php:7.4-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-install zip pdo_mysql \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY .env .
COPY . .

RUN composer install --no-scripts --no-interaction

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage

EXPOSE 9001

# CMD ["php-fpm"]
# Exécutez la commande artisan serve lors du démarrage du conteneur
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8000"]

LABEL image_name="atypikhouse"