FROM php:8.1-apache

# Installation des extensions nécessaires et de p7zip
RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev \
        libzip-dev \
        p7zip-full \
        unzip \
        nano \
    && docker-php-ext-install mysqli pdo pdo_mysql zip fileinfo

# Définir le répertoire où PHP doit rechercher les fichiers de configuration ini
ENV PHP_INI_SCAN_DIR /usr/local/etc/php

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copier les fichiers de configuration PHP
COPY ./php.ini-development /usr/local/etc/php/php.ini
COPY ./000-default.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite









