FROM php:7.4-fpm

# Starting from scratch
RUN apt-get clean
RUN apt-get -y autoremove
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Dependencies
RUN apt-get update

# Zip
RUN apt-get install -y libzip-dev zip && docker-php-ext-configure zip && docker-php-ext-install zip

# Git
RUN apt-get install -y git

# Curl
RUN apt-get install -y libcurl3-dev curl && docker-php-ext-install curl

# GD
RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd

# PostgreSQL
# RUN apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql

# MySQL
# RUN docker-php-ext-install pdo_mysql exif pcntl

# MongoDB
RUN apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev
RUN pecl install mongodb && docker-php-ext-enable mongodb

# BC Math
RUN docker-php-ext-install bcmath

# Human Language and Character Encoding Support
RUN apt-get install -y zlib1g-dev libicu-dev g++ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

# PHP Redis extension
RUN pecl install redis
RUN docker-php-ext-enable redis

# Custom php.ini config
COPY docker/prod/php/php.ini /usr/local/etc/php/php.ini

# Install Xdebug
# RUN pecl install xdebug
# RUN docker-php-ext-enable xdebug

# Composer installation
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Install Mysql Client for dump
RUN apt-get install -y mariadb-client

# Clean up
RUN apt-get clean
RUN apt-get -y autoremove
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY ./api /var/www/api

# Set up default directory
WORKDIR /var/www/api

RUN composer remove spatie/laravel-backup

RUN composer install

RUN chown -R www-data:www-data \
    /var/www/api/storage \
    /var/www/api/bootstrap/cache

RUN chmod -R 775 storage bootstrap/cache        

RUN rm public/storage

RUN php artisan storage:link

# RUN php artisan optimize
