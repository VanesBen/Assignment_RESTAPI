#!/bin/sh

# Cache configuration & routes
php artisan config:cache
php artisan route:cache

# Run database migrations automatically on deployment
php artisan migrate --force

# Exec the main container command (Apache)
exec "$@"