#!/usr/bin/env bash
echo "Running composer"
composer global require hirak/prestissimo --ignore-platform-reqs
composer global config --no-plugins allow-plugins.hirak/prestissimo true
composer install --no-dev --working-dir=/var/www/html

echo "generating application key..."
php artisan key:generate --show

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate:fresh --seed --force



