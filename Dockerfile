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

# Enable Apache modules
RUN a2enmod rewrite headers
RUN a2dissite 000-default
RUN a2ensite default-ssl

# Create Apache config for CodeIgniter
RUN cat > /etc/apache2/sites-available/codeigniter.conf <<'EOF'
<VirtualHost *:80>
    ServerAdmin admin@example.com
    ServerName localhost
    DocumentRoot /var/www/html/public

    <Directory /var/www/html/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
        
        <IfModule mod_rewrite.c>
            RewriteEngine On
            RewriteBase /
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            RewriteRule ^(.*)$ index.php?/$1 [L]
        </IfModule>
    </Directory>

    <Directory /var/www/html>
        Require all denied
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/codeigniter-error.log
    CustomLog ${APACHE_LOG_DIR}/codeigniter-access.log combined
</VirtualHost>
EOF

RUN a2dissite default-ssl && a2ensite codeigniter
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

# Set permissions for writable directories
RUN chmod -R 755 /var/www/html && \
    chmod -R 777 /var/www/html/writable && \
    chown -R www-data:www-data /var/www/html/writable

# Expose port
EXPOSE 80

# Use entrypoint script
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
