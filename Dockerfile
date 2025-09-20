FROM php:8.4-fpm-alpine

# Install nginx and supervisor
RUN apk add --no-cache nginx supervisor nodejs npm

# Install PHP extensions
RUN set -eux; \
  apk update; \
  # runtime libs & tools
  apk add --no-cache \
    curl \
    unzip \
    icu-libs \
    libzip \
    libpng \
    libjpeg-turbo \
    freetype \
    postgresql-libs; \
  apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    icu-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    postgresql-dev \
    libxml2-dev \
    zlib-dev \
    oniguruma \
    oniguruma-dev \
    curl-dev; \
  docker-php-ext-configure gd --with-freetype --with-jpeg; \
  docker-php-ext-install -j"$(nproc)" \
    mbstring \
    curl \
    gd \
    pdo_pgsql \
    pgsql \
    opcache \
    intl \
    zip \
    bcmath \
    soap; \
  apk del .build-deps


# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy application files first
COPY . .

# Install composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Install npm dependencies and build
RUN npm install

# Build frontend assets
RUN npm run build

# Copy config files
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisord.conf
COPY docker/entrypoint.sh /entrypoint.sh

# Set permissions and prepare for storage
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod +x /entrypoint.sh

EXPOSE 80

CMD ["/entrypoint.sh"]
