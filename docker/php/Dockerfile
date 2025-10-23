FROM php:8.1-fpm

ARG UID=1000
ARG GID=1000

RUN apt-get update && apt-get install -y \
    git curl unzip \
    zlib1g-dev libzip-dev \
    default-mysql-client \
    && docker-php-ext-configure zip \
    && docker-php-ext-install pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

RUN groupadd -g ${GID} app \
    && useradd  -u ${UID} -g app -m -s /bin/bash app

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY docker/php/php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www

RUN mkdir -p /var/www/storage /var/www/bootstrap/cache \
    && chown -R app:app /var/www

USER app
