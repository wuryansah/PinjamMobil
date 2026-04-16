#!/bin/sh
set -e

echo "🚀 Starting PinjamMobil application..."

# Wait for MySQL to be ready
echo "⏳ Waiting for database to be ready..."
while ! nc -z db 3306; do
    sleep 1
done
echo "✅ Database is ready!"

# Wait for Redis to be ready
echo "⏳ Waiting for Redis to be ready..."
while ! nc -z redis 6379; do
    sleep 1
done
echo "✅ Redis is ready!"

# Run migrations if not in production (to avoid accidental data loss)
if [ "$APP_ENV" != "production" ]; then
    echo "🔄 Running database migrations..."
    php artisan migrate --force
    echo "✅ Migrations complete!"
fi

# Optimize Laravel
if [ "$APP_ENV" = "production" ]; then
    echo "⚡ Optimizing Laravel for production..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan event:cache
    echo "✅ Laravel optimized!"
fi

# Set proper permissions
echo "🔒 Setting permissions..."
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

echo "✨ PinjamMobil is ready!"

# Execute the CMD
exec "$@"
