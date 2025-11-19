#!/bin/bash
set -e

# Create logs directory if needed
mkdir -p /var/log/apache2

# Configure Apache to listen on the PORT environment variable
PORT=${PORT:-80}
echo "Listen $PORT" > /etc/apache2/ports.conf

# Start Apache in foreground with logging to stdout
exec apache2ctl -D FOREGROUND
