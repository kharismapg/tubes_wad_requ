#!/bin/bash
set -e

echo "Waiting for MySQL to be ready..."
# Loop ini akan terus mencoba bermigrasi sampai database cloud-nya siap menerima koneksi
until php artisan migrate --force --no-interaction 2>/dev/null; do
    echo "Database not ready, retrying in 5 seconds..."
    sleep 5
done

echo "Running seeders..."
php artisan db:seed --force --no-interaction

echo "Starting application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Jalankan server utama (Railway Laravel biasanya menggunakan FrankenPHP atau PHP-FPM)
# Jika buildpack kamu bawaannya menggunakan php artisan serve, biarkan Railway yang mengaturnya, 
# Tapi untuk amannya script bawaan php-fpm bisa dimasukkan atau dikosongkan jika pakai web server bawaan.