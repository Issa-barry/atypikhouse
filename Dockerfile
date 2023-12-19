# Utilisez l'image PHP 7.4 avec Apache
FROM php:7.4-apache

# Active le module Apache mod_rewrite
RUN a2enmod rewrite

# Installe les dépendances nécessaires pour Laravel
RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install zip pdo pdo_mysql

# Copie les fichiers de l'application Laravel dans le conteneur
COPY . /var/www/html
COPY .env .

# Définit l'utilisateur www-data comme propriétaire des fichiers Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && chmod -R 777 /var/www/html/storage

# Installe Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installe les dépendances PHP de l'application Laravel
RUN composer install --optimize-autoloader --no-dev

# Génère la clé d'application Laravel
RUN php artisan key:generate

# Expose le port 80 pour Apache
EXPOSE 80

# Lance le serveur Apache au démarrage du conteneur
CMD ["apache2-foreground"]
