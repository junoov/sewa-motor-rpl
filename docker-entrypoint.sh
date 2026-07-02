#!/bin/sh
set -e

echo "🚀 MotoRent Docker Entrypoint"

# Jika vendor kosong (pertama kali), install composer
if [ ! -f vendor/autoload.php ]; then
    echo "📦 Installing Composer dependencies..."
    composer install --optimize-autoloader --no-interaction
fi

# Copy .env.docker jika .env belum ada di container
IS_FIRST_RUN=false
if [ ! -f .env ]; then
    echo "⚙️ Setting up .env from .env.docker..."
    cp .env.docker .env
    php artisan key:generate --force
    IS_FIRST_RUN=true
fi

# Laravel optimizations
echo "⚡ Caching config, routes, views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Storage link
php artisan storage:link --force 2>/dev/null || true

# Pastikan storage directories writable
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

# Run migrations & seed (Otomatis seed di awal pembuatan project)
if [ "$IS_FIRST_RUN" = "true" ]; then
    echo "🗃️ First run detected! Running migrations and seeding demo data..."
    php artisan migrate:fresh --seed --force
else
    echo "🗃️ Running migrations..."
    php artisan migrate --force
fi

# Filament upgrade cache
php artisan filament:upgrade 2>/dev/null || true

echo "✅ MotoRent ready!"

# Jika ada command argument (misalnya queue worker), jalankan itu
# Jika tidak, default ke php-fpm
if [ $# -gt 0 ]; then
    echo "🔧 Running custom command: $@"
    exec "$@"
else
    echo "🟢 Starting PHP-FPM..."
    exec php-fpm
fi
