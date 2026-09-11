#!/bin/sh
set -e

if [ -z "$APP_KEY" ]; then
  echo "WARNING: APP_KEY is not set. Generating one for this run."
  php artisan key:generate --force
fi

php artisan storage:link || true
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

PORT="${PORT:-10000}"
echo "Starting Laravel on 0.0.0.0:${PORT}"
exec php artisan serve --host=0.0.0.0 --port="${PORT}"
