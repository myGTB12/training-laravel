#!/bin/sh

composer install --prefer-dist --optimize-autoloader
npm install
#npm run build
chmod -R 777 storage bootstrap/cache

echo "🕒 Waiting for MySQL to be ready..."

# MySQL check loop
until nc -z -v -w30 mysql 3306; do
  echo "⏳ MySQL is unavailable - sleeping"
  sleep 5
done

echo "✅ MySQL is up - executing migrations"
# .env
if [ ! -f /var/www/.env ]; then
    #Copy .env file from .env.local
    cp /var/www/.env.local /var/www/.env

    # Create JWT Secret in .env file
    php artisan jwt:secret --force

    echo ".env file has been created."
fi

# Run migrate and seed database
php artisan migrate --seed --force

## php-fpm
/usr/local/sbin/php-fpm