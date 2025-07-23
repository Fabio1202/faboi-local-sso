#!/bin/bash

if [ ! -f .env ]; then
    echo "Creating .env file from .env.example"
    cp .env.example .env
fi

touch database.sqlite

# This script sets up the environment for Faboi SSO
php artisan migrate --force

php artisan key:generate
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

php artisan permissions:update

php artisan octane:frankenphp
