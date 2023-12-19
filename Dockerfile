FROM php:7.4-apache

WORKDIR /var/www/html

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    nginx \
    supervisor \
    && docker-php-ext-install zip pdo_mysql \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY .env .
COPY . .
RUN apt-get update && apt-get install -y nano

RUN composer install --optimize-autoloader --no-dev

RUN composer install --no-scripts --no-interaction

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage

EXPOSE 80

CMD ["apache2-foreground"]

LABEL image_name="atypikhouse"