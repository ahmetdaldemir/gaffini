#!/bin/bash

# Start Apache
apache2-foreground &

# Wait for Apache to start
sleep 10

# Run Laravel migrations if needed
php artisan migrate --force

# Create storage link if not exists
php artisan storage:link

# Clear caches
php artisan config:clear
php artisan cache:clear

# Keep container running
wait
