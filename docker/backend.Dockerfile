# Use official PHP image
FROM php:8.2-cli

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y unzip curl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy Laravel backend files
COPY backend /var/www

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Expose port 8000 for Laravel
EXPOSE 8000

# Start Laravel server
CMD php artisan serve --host=0.0.0.0 --port=8000
