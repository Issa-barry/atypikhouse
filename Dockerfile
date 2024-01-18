# Utiliser l'image officielle PHP 7.4
FROM php:7.4-apache

# Installer les dépendances nécessaires pour Laravel
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        unzip \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev && \
    docker-php-ext-install zip pdo_mysql gd

# Activer le module Apache mod_rewrite
RUN a2enmod rewrite

# Copier les fichiers de l'application Laravel dans le conteneur
COPY . /var/www/html

# Définir les permissions appropriées pour les dossiers de stockage Laravel
RUN chown -R www-data:www-data /var/www/html/storage

# Exposer le port 80
EXPOSE 80

# Commande par défaut pour démarrer Apache
CMD ["apache2-foreground"]
