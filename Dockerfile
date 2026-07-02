FROM php:8.4-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    git curl zip unzip libzip-dev libpng-dev libjpeg-turbo-dev \
    freetype-dev icu-dev oniguruma-dev libxml2-dev \
    linux-headers nodejs npm $PHPIZE_DEPS

# Install PHP extensions (semua yang dibutuhkan Laravel 12 + Filament 4)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql mbstring exif pcntl bcmath gd intl \
        xml ctype fileinfo opcache zip

# Install Redis PHP extension
RUN pecl install redis && docker-php-ext-enable redis

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy PHP config files
COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini

# PHP-FPM tuning
RUN echo "[www]" > /usr/local/etc/php-fpm.d/zz-tuning.conf && \
    echo "pm = dynamic" >> /usr/local/etc/php-fpm.d/zz-tuning.conf && \
    echo "pm.max_children = 20" >> /usr/local/etc/php-fpm.d/zz-tuning.conf && \
    echo "pm.start_servers = 4" >> /usr/local/etc/php-fpm.d/zz-tuning.conf && \
    echo "pm.min_spare_servers = 2" >> /usr/local/etc/php-fpm.d/zz-tuning.conf && \
    echo "pm.max_spare_servers = 6" >> /usr/local/etc/php-fpm.d/zz-tuning.conf

WORKDIR /var/www/html

# Copy entrypoint dan convert line endings (Windows CRLF → Linux LF)
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN sed -i 's/\r$//' /usr/local/bin/docker-entrypoint.sh && \
    chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 9000
ENTRYPOINT ["docker-entrypoint.sh"]
