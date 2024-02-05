# Utilisez une image de PHP 7.4 avec Apache
FROM php:7.4-apache

# Activez le module Apache mod_rewrite
RUN a2enmod rewrite

# Mise à jour et installation de dépendances,  
# Ajoutez cette ligne pour installer le paquet libgd
RUN apt-get update && \
    apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    libgd-dev \ 
    unzip \
    && docker-php-ext-install -j$(nproc) pdo pdo_mysql gd zip

#Symlink
RUN ln -sf /var/www/html/storage/app/public /var/www/html/public/storage || true

# Copiez les fichiers de l'application Laravel dans le conteneur
COPY . /var/www/html

# Définissez les permissions appropriées
RUN chown -R www-data:www-data /var/www/html/storage/logs /var/www/html/bootstrap/cache
RUN chmod -R 777 /var/www/html/storage/logs /var/www/html/bootstrap/cache

# Exposez le port 80 du conteneur
EXPOSE 80

# Commande par défaut pour le conteneur
CMD ["apache2-foreground"]
