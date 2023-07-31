# Use the official PHP image as the base image
FROM php:8.1-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Set the working directory
WORKDIR /var/www/html

# Copy your PHP application files to the container
COPY . /var/www/html

# Expose the port used by PHP-FPM
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]

