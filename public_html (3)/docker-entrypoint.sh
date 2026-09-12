#!/bin/sh
set -e

if [ -z "$APP_KEY" ]; then
  echo "WARNING: APP_KEY is not set. Generating one for this run."
  php artisan key:generate --force
fi

php artisan storage:link || true
php artisan migrate --force

if [ "${SEED_DATABASE_IF_EMPTY:-false}" = "true" ]; then
  if php artisan tinker --execute='exit(\App\Models\AboutWebsite::query()->exists() ? 0 : 1);'; then
    echo "Database content already exists; skipping seeders."
  else
    echo "Database content is empty; running seeders."
    php artisan db:seed --force
  fi
fi

php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:clear

echo "===== LARAVEL VIEW DIAGNOSTIC ====="
pwd
echo "PHP:"
php -v
echo "Directory:"
ls -la /var/www/html
echo "Resources:"
ls -la /var/www/html/resources || true
echo "Views:"
ls -la /var/www/html/resources/views || true
echo "Blade files:"
find /var/www/html/resources/views -type f -name "*.blade.php" | head -30 || true
echo "Laravel paths:"
php artisan tinker --execute='dump([
  "base_path" => base_path(),
  "resource_path" => resource_path(),
  "view_paths" => config("view.paths"),
  "compiled_views" => config("view.compiled"),
]);'
echo "Compiled views directory:"
ls -la /var/www/html/storage/framework/views || true
echo "===== END LARAVEL VIEW DIAGNOSTIC ====="

php artisan view:cache

PORT="${PORT:-10000}"
echo "Starting Laravel on 0.0.0.0:${PORT}"
exec php artisan serve --host=0.0.0.0 --port="${PORT}"
