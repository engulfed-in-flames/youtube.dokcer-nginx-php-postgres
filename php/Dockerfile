FROM php:8.3.8-fpm-alpine3.20

# Install system dependencies
RUN apk update && apk add --no-cache \
    postgresql-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copy custom php.ini
# COPY php.ini /usr/local/etc/php/

# Use 'composer' from the official image
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Set working directory
WORKDIR /var/www