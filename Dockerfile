# Use a PHP image with Apache
FROM php:8.1-apache

# Enable required extensions
RUN docker-php-ext-install pdo pdo_pgsql

# Copy your project into the container
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

# Start the Apache server
CMD ["apache2-foreground"]
