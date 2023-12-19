# Utilisez l'image PHP avec Composer installé
FROM composer:2 AS builder

WORKDIR /app

# Copiez les fichiers de configuration
COPY composer.json composer.json
COPY composer.lock composer.lock

# Installez les dépendances
RUN composer install --no-dev --ignore-platform-reqs

# Copiez le reste des fichiers
COPY . .
COPY .env .

# Construisez l'application
RUN composer dump-autoload --optimize

# Image de production légère
FROM php:7.4-fpm-alpine

WORKDIR /var/www/html

# Installez les dépendances nécessaires pour Laravel
RUN apk add --no-cache --virtual .build-deps \
    build-base \
    autoconf \
    && docker-php-ext-install pdo pdo_mysql \
    && apk del .build-deps

# Copiez les fichiers de l'étape précédente
COPY --from=builder /app /var/www/html

# Définissez l'utilisateur et les permissions
RUN addgroup -g 1000 -S www && \
    adduser -u 1000 -D -S -G www www && \
    chown -R www:www /var/www/html

# Exposez le port sur lequel Laravel fonctionne par défaut
EXPOSE 9002

CMD ["php-fpm"]
