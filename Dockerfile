FROM node:20 AS node

WORKDIR /app

COPY package*.json vite.config.js tailwind.config.js postcss.config.cjs /app/
COPY resources/ /app/resources/

RUN mkdir -p /app/public

RUN npm install
RUN npm run build

FROM composer:2 AS composer
WORKDIR /app
COPY composer.json composer.lock /app/

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

FROM dunglas/frankenphp:latest

COPY --from=composer /app/vendor /var/www/vendor
COPY --from=node /app/public/build /var/www/public/build

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    libicu-dev \
    nginx \
    cron \
    && docker-php-ext-configure intl \
    && docker-php-ext-install \
    pdo \
    pdo_pgsql \
    zip \
    pdo_mysql \
    intl \
    pcntl

WORKDIR /var/www

COPY --chown=www-data:www-data . /var/www

EXPOSE 8000
VOLUME /var/www/.env
VOLUME /var/www/storage

# Execute /docker/setup.sh on container start
COPY docker/setup.sh /usr/local/bin/setup
RUN chmod +x /usr/local/bin/setup

ENTRYPOINT ["setup"]
