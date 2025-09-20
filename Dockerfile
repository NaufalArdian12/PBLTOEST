FROM php:8.4-fpm-alpine

# Install nginx and supervisor
RUN apk add --no-cache nginx supervisor nodejs npm

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql pgsql intl zip gd bcmath soap opcache

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

# Set permissions and prepare for SQLite
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 storage bootstrap/cache \
    && chmod +x /entrypoint.sh

EXPOSE 80

CMD ["/start.sh"]
