#!/bin/sh
set -e

echo "🚀 MotoRent Docker Entrypoint"

# HANYA JALANKAN SETUP JIKA CONTAINER UTAMA (APP)
# (Queue worker akan skip bagian ini dan langsung eksekusi command di bawah)
if [ $# -eq 0 ]; then
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

    # Pastikan storage directories ada dan writable
    echo "📁 Ensuring storage directories exist..."
    mkdir -p storage/framework/cache/data
    mkdir -p storage/framework/views
    mkdir -p storage/framework/sessions
    mkdir -p storage/logs
    chmod -R 777 storage bootstrap/cache 2>/dev/null || true

    # Run migrations
    echo "🗃️ Running migrations..."
    php artisan migrate --force

    # Cek apakah database butuh di-seed (jika jumlah motor = 0)
    echo "🌱 Checking if database needs seeding..."
    DB_MOTOR_COUNT=$(php artisan tinker --execute="echo App\Models\Motor::count();" 2>/dev/null | tr -d '\r\n[:space:]')
    if [ "$DB_MOTOR_COUNT" = "0" ]; then
        echo "🌱 Database empty! Seeding initial demo data..."
        php artisan db:seed --force
    else
        echo "✅ Database already has data (Count: $DB_MOTOR_COUNT). Skipping seed."
    fi

    # Filament upgrade cache
    php artisan filament:upgrade 2>/dev/null || true
fi

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
