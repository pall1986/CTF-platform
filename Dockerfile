FROM php:8.2-apache

# Installa estensioni PHP necessarie
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Abilita mod_rewrite
RUN a2enmod rewrite

# Imposta ServerName per evitare warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf