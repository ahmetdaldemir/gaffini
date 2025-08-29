#!/bin/bash

# Start nginx
service nginx start

# Start PHP-FPM
php-fpm -D

# Wait for services to start
sleep 5

# Run Laravel migrations if needed
php artisan migrate --force

# Keep container running
tail -f /dev/null
