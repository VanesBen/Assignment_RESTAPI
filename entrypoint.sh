#!/bin/sh

php artisan config:clear
php artisan route:clear
php artisan cache:clear


php artisan migrate:fresh --seed --force

exec "$@"