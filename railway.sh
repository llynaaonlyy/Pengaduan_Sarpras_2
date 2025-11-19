#!/usr/bin/env bash
set -e

echo "Running CodeIgniter 4 application in Railway..."

# Install dependencies
echo "Installing dependencies..."
composer install --no-interaction --prefer-dist

# Clear cache
echo "Clearing cache..."
php spark cache:clear

# Run migrations (optional - uncomment if needed)
# echo "Running database migrations..."
# php spark migrate

echo "Application setup complete!"
