# ---- build composer deps ----
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-scripts
COPY . .
RUN composer dump-autoload -o

# ---- build assets (Vite) ----
FROM node:20 AS assets
WORKDIR /app
COPY package.json package-lock.json* ./
RUN npm ci
COPY . .
RUN npm run build

# ---- runtime (PHP + Apache) ----
FROM php:8.3-apache

# Install ekstensi yang diperlukan
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zlib1g-dev \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libpq-dev \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install -j$(nproc) gd zip pdo_pgsql \
 && a2enmod rewrite \
 && rm -rf /var/lib/apt/lists/*

# Laravel jalan dari /public
RUN sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

# Copy source + vendor + assets
COPY --chown=www-data:www-data . .
COPY --from=vendor /app/vendor /var/www/html/vendor
COPY --from=assets /app/public/build /var/www/html/public/build

# Bootstrapping & optimasi saat start
CMD php -r "if(!file_exists('.env') && file_exists('.env.example')) copy('.env.example','.env');" \
 && php artisan key:generate --force \
 && php artisan config:cache && php artisan route:cache && php artisan view:cache \
 && php artisan migrate --force || true \
 && apache2-foreground
