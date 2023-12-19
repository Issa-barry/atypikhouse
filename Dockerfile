# Utilisez l'image PHP 7.4 avec Apache
FROM php:7.4-apache

WORKDIR /var/www/html

# Active le module Apache mod_rewrite
RUN a2enmod rewrite

# Installe les dépendances nécessaires pour Laravel
RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libonig-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-install zip pdo pdo_mysql mbstring exif pcntl bcmath \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Copie les fichiers de l'application Laravel dans le conteneur
COPY atypikhouse/ .

# Définit l'utilisateur www-data comme propriétaire des fichiers Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Installe Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installe les dépendances PHP de l'application Laravel
RUN cd /var/www/html && composer install --optimize-autoloader --no-dev

# Installe le fournisseur de service Barryvdh\Debugbar
RUN cd /var/www/html && composer require barryvdh/laravel-debugbar

# Génère la clé d'application Laravel
RUN cd /var/www/html && php artisan key:generate

# Expose le port 80 pour Apache
EXPOSE 80

# Lance le serveur Apache au démarrage du conteneur
CMD ["apache2-foreground"]
