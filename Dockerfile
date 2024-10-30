# Utilise l'image officielle PHP avec FPM
FROM php:8.3-fpm

# Installe les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql

# Configure PHP-FPM pour écouter sur toutes les interfaces
RUN sed -i 's/listen = \/run\/php\/php-fpm.sock/listen = 0.0.0.0:9000/' /usr/local/etc/php-fpm.d/zz-docker.conf

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configure le répertoire de travail dans le conteneur
WORKDIR /var/www/html

# Copie les fichiers de l'application Laravel dans le conteneur
COPY . /var/www/html

# Donne les permissions nécessaires
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Installe les dépendances Laravel avec Composer
RUN composer install --no-interaction --optimize-autoloader

# Expose le port 9000 pour PHP-FPM
EXPOSE 9000

# Commande pour démarrer PHP-FPM
CMD ["php-fpm"]
