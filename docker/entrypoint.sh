#!/bin/sh

# Create SQLite database if it doesn't exist
#if [ ! -f /var/www/html/database/database.sqlite ]; then
#    touch /var/www/html/database/database.sqlite
#    chmod 666 /var/www/html/database/database.sqlite
#    chown www-data:www-data /var/www/html/database/database.sqlite
#fi

# Run migrations
# php artisan migrate --force

php artisan route:clear
php artisan optimize
php artisan db:table
cat /var/www/html/.env

# Start supervisor
exec /usr/bin/supervisord -c /etc/supervisord.conf
