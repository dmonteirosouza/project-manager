#!/bin/sh

cd /var/www/html

composer install
php artisan cache:clear
php artisan config:cache
php artisan migrate:fresh --seed
php artisan serve --host=0.0.0.0 --port=$APP_PORT
