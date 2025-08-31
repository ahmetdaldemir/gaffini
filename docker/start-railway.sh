#!/bin/bash

# Function to wait for database connection
wait_for_db() {
    echo "Waiting for database connection..."
    max_attempts=30
    attempt=1
    
    while [ $attempt -le $max_attempts ]; do
        echo "Attempt $attempt/$max_attempts: Testing database connection..."
        
        if php artisan tinker --execute="DB::connection()->getPdo();" 2>/dev/null; then
            echo "Database connection established!"
            return 0
        else
            echo "Database connection failed. Retrying in 10 seconds..."
            sleep 10
            attempt=$((attempt + 1))
        fi
    done
    
    echo "Failed to connect to database after $max_attempts attempts. Continuing anyway..."
    return 1
}

# Start Apache
echo "Starting Apache..."
apache2-foreground &
APACHE_PID=$!

# Wait for Apache to start
sleep 5

# Wait for database connection
wait_for_db

# Generate APP_KEY if not exists
echo "Checking APP_KEY..."
if [ -z "$(php artisan tinker --execute='echo config(\"app.key\");' 2>/dev/null | grep -v '^$')" ]; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force
else
    echo "APP_KEY already exists."
fi

# Run Laravel migrations if needed
echo "Running migrations..."
if php artisan migrate:status --no-interaction | grep -q "No migrations found"; then
    echo "No migrations to run."
else
    php artisan migrate --force --no-interaction
fi

# Create storage link if not exists
echo "Creating storage link..."
php artisan storage:link --force

# Clear caches
echo "Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Optimize for production
echo "Optimizing for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Application is ready!"

# Keep container running
wait $APACHE_PID
