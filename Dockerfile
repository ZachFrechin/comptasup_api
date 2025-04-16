# Utilise l'image officielle PHP avec FPM
FROM php:8.3-fpm

# Installe les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libmagickwand-dev \
    imagemagick \
    ghostscript \
    && docker-php-ext-install pdo_mysql \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Configure ImageMagick policy for PDF
RUN mkdir -p /etc/ImageMagick-6 && \
    echo '<?xml version="1.0" encoding="UTF-8"?>' > /etc/ImageMagick-6/policy.xml && \
    echo '<!DOCTYPE policymap [<!ELEMENT policymap (policy)+> <!ELEMENT policy EMPTY> <!ATTLIST policy domain (delegate|coder|filter|path|resource) #REQUIRED> <!ATTLIST policy name CDATA #REQUIRED> <!ATTLIST policy rights CDATA #REQUIRED> <!ATTLIST policy pattern CDATA #IMPLIED> <!ATTLIST policy value CDATA #IMPLIED> ]>' >> /etc/ImageMagick-6/policy.xml && \
    echo '<policymap>' >> /etc/ImageMagick-6/policy.xml && \
    echo '  <policy domain="coder" rights="read|write" pattern="PDF" />' >> /etc/ImageMagick-6/policy.xml && \
    echo '  <policy domain="coder" rights="read|write" pattern="LABEL" />' >> /etc/ImageMagick-6/policy.xml && \
    echo '</policymap>' >> /etc/ImageMagick-6/policy.xml

# Configure PHP-FPM pour écouter sur toutes les interfaces
RUN sed -i 's/listen = \/run\/php\/php-fpm.sock/listen = 0.0.0.0:9000/' /usr/local/etc/php-fpm.d/zz-docker.conf

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configure le répertoire de travail dans le conteneur
WORKDIR /var/www/html

# Copie uniquement les fichiers nécessaires pour composer install
COPY composer.json composer.lock ./
RUN composer install --no-interaction --optimize-autoloader --no-scripts

# Copie le reste des fichiers
COPY . .

# Donne les permissions nécessaires
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose le port 9000 pour PHP-FPM
EXPOSE 9000

# Commande pour démarrer PHP-FPM
CMD ["php-fpm"]
