FROM php:8.2-apache

# Copia los archivos del proyecto al directorio raíz de Apache
COPY . /var/www/html

# Instala las extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Configura permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Habilita mod_rewrite si usas URL amigables
RUN a2enmod rewrite