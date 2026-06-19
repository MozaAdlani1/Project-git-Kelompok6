# 1. Gunakan base image PHP versi 8.2
FROM php:8.2-fpm

# 2. Install dependencies yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql pdo_sqlite

# 3. Set working directory
WORKDIR /var/www

# 4. Copy semua file dari laptop ke dalam container
COPY . .

# 5. Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 6. Siapkan database SQLite dan beri hak akses
RUN touch database/database.sqlite \
    && chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache database/database.sqlite

# 7. Menjalankan aplikasi
EXPOSE 8080

# Migrasi otomatis dan jalankan server
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080