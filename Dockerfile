# Multi-stage build for Railway deployment
FROM php:8.2-apache

# Install required PHP extensions
RUN docker-php-ext-install mysqli intl mbstring pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html/

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Set up writable directory permissions
RUN chmod -R 777 /var/www/html/writable

# Configure Apache DocumentRoot to public folder
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Add Apache configuration for CodeIgniter
RUN echo '<Directory /var/www/html/public>' > /etc/apache2/conf-available/codeigniter.conf && \
    echo '    AllowOverride All' >> /etc/apache2/conf-available/codeigniter.conf && \
    echo '    Require all granted' >> /etc/apache2/conf-available/codeigniter.conf && \
    echo '</Directory>' >> /etc/apache2/conf-available/codeigniter.conf && \
    a2enconf codeigniter

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
