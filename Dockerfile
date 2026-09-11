# Render deploys the Laravel app stored in public_html (3) through Docker.
FROM php:8.4-cli AS vendor
WORKDIR /app
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev \
    && docker-php-ext-install zip \
    && rm -rf /var/lib/apt/lists/*
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY ["public_html (3)/composer.json", "public_html (3)/composer.lock", "./"]
RUN composer install --no-dev --no-scripts --prefer-dist --optimize-autoloader

FROM node:20-alpine AS assets
WORKDIR /app
COPY ["public_html (3)/package.json", "public_html (3)/package-lock.json", "./"]
RUN npm ci
COPY ["public_html (3)/", "./"]
RUN npm run build

FROM php:8.4-cli AS app
WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev libpq-dev \
    && docker-php-ext-install \
        pdo_pgsql \
        pgsql \
        zip \
        gd \
        mbstring \
        xml \
        bcmath \
    && rm -rf /var/lib/apt/lists/*

COPY --from=vendor /app/vendor ./vendor
COPY ["public_html (3)/", "./"]
COPY --from=assets /app/public/build ./public/build

RUN cp -n .env.example .env || true \
    && mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

COPY ["public_html (3)/docker-entrypoint.sh", "/usr/local/bin/docker-entrypoint.sh"]
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 10000
ENTRYPOINT ["docker-entrypoint.sh"]
