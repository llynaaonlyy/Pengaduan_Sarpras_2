# Multi-stage build for Railway deployment
FROM php:8.2-apache

# Install required system packages and PHP extensions
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        g++ \
        make \
        autoconf \
        pkg-config \
        libicu-dev \
        libxml2-dev \
        zlib1g-dev \
        libzip-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libonig-dev \
        default-mysql-client \
        unzip \
        git \
        curl \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j"$(nproc)" intl mysqli pdo pdo_mysql mbstring zip \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html/

# Copy and make entrypoint script executable
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-reqs

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

# Configure Apache to listen on PORT environment variable (Railway)
RUN echo 'Listen ${PORT}' > /etc/apache2/ports.conf.in

# Expose port
EXPOSE 80

# Use entrypoint script
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
