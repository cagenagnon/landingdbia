FROM php:8.4-cli-bookworm

# System dependencies and PHP extensions used by Laravel
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libzip-dev \
        libsqlite3-dev \
        libpq-dev \
        libonig-dev \
    && docker-php-ext-install \
        bcmath \
        mbstring \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        pdo_sqlite \
        zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Install PHP dependencies first for layer caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copy application code
COPY . .

# Ensure runtime folders exist
RUN mkdir -p storage/logs bootstrap/cache

EXPOSE 8080

CMD ["sh", "-lc", "php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"]
