#!/bin/sh

# Create SQLite database if it doesn't exist
#if [ ! -f /var/www/html/database/database.sqlite ]; then
#    touch /var/www/html/database/database.sqlite
#    chmod 666 /var/www/html/database/database.sqlite
#    chown www-data:www-data /var/www/html/database/database.sqlite
#fi

if[ ! -f /var/www/html/storage/logs/laravel.log ]; then
    touch /var/www/html/storage/logs/laravel.log
    chmod 777 /var/www/html/storage/logs/laravel.log
    chown www-data:www-data /var/www/html/storage/logs/laravel.log
fi

# Run migrations
# php artisan migrate --force

php artisan route:clear
php artisan optimize

# Start supervisor
exec /usr/bin/supervisord -c /etc/supervisord.conf
