#!/bin/bash
set -e

# Configure Apache to listen on the PORT environment variable
PORT=${PORT:-80}
echo "Listen $PORT" > /etc/apache2/ports.conf

# Start Apache in foreground
exec apache2-foreground
