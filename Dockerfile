# Utilisez une image de PHP 7.4 avec Apache
FROM php:7.4-apache

# Activez le module Apache mod_rewrite
RUN a2enmod rewrite

# Installez les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    gd \
    && docker-php-ext-install pdo pdo_mysql zip 

# Copiez les fichiers de l'application Laravel dans le conteneur
COPY . /var/www/html

# Définissez les permissions appropriées
RUN chown -R www-data:www-data /var/www/html/storage/logs /var/www/html/bootstrap/cache
RUN chmod -R 777 /var/www/html/storage/logs /var/www/html/bootstrap/cache

# Exposez le port 80 du conteneur
EXPOSE 80

# Commande par défaut pour le conteneur
CMD ["apache2-foreground"]
