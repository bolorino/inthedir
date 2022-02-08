#!/bin/sh
set -e
echo "Deploying application ..."

# Enter maintenance mode
(php artisan down) || true

# Update codebase
git fetch origin deploy
git reset --hard origin/deploy

# Install dependencies based on lock file
composer install --no-interaction --prefer-dist --optimize-autoloader

# Migrate database
# php artisan migrate --force

# Note: If you're using queue workers, this is the place to restart them.
# ...

# Clear cache
php artisan optimize

# Reload PHP to update opcache
# echo "" | sudo -S service php8.1-fpm reload

# Exit maintenance mode
php artisan up

echo "Application deployed!"