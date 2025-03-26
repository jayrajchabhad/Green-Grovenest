# Use an official PHP 8.3 image with Apache and necessary extensions
FROM php:8.3-apache

# Set environment variables
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Update and install necessary dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    libssl-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libmcrypt-dev \
    libbz2-dev \
    libzip-dev \
    libsqlite3-dev \
    && apt-get clean

# Enable required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# Install MongoDB PHP extension
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Install Composer globally
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install NodeJS and NPM
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    npm install -g npm

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy project files to container
COPY . .

# Set file permissions for storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

# Run Laravel artisan commands to optimize and migrate
RUN composer install --no-dev --optimize-autoloader && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force

# Start Apache in the foreground
CMD ["apache2-foreground"]
