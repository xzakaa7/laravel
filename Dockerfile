FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    locales \
    unzip \
    git \
    curl \
    zlib1g-dev \
    libicu-dev \
    libxml2-dev \
    libxslt1-dev \
    libcurl4-openssl-dev \
    pkg-config

# Install PHP extensions
RUN docker-php-ext-install \
    intl \
    mbstring \
    pdo_mysql \
    zip \
    bcmath \
    gd \
    exif \
    pcntl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install project dependencies
RUN composer install --optimize-autoloader --no-dev

# Expose port
EXPOSE 8000

# Start Laravel
CMD php artisan serve --host=0.0.0.0 --port=$PORT
