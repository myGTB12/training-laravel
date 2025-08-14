FROM node:22 AS node_builder
FROM php:8.1-fpm

# Necessary extension
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    netcat-openbsd \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo_mysql bcmath

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#NodeJS
COPY --from=node_builder /usr/local/ /usr/local/

# Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
COPY ./docker/laravel/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY ./docker/laravel/custom-php.ini /usr/local/etc/php/conf.d/custom-php.ini

# Laravel source
WORKDIR /var/www
COPY ./src /var/www

# Add user matching host UID/GID
ARG USER_ID=1000
ARG GROUP_ID=1000
RUN groupadd -g $GROUP_ID hostgroup \
    && useradd -u $USER_ID -g $GROUP_ID -m hostuser \
    && chown -R hostuser:hostgroup /var/www

# entrypoint.sh copy
COPY ./docker/laravel/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

USER hostuser

ENTRYPOINT ["/entrypoint.sh"]

CMD ["php-fpm"]
