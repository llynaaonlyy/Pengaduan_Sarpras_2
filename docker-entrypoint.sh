#!/bin/bash
set -e

# Create logs directory if needed
mkdir -p /var/log/apache2

# Configure Apache to listen on the PORT environment variable
PORT=${PORT:-80}
echo "Listen $PORT" > /etc/apache2/ports.conf

# Replace ${PORT} placeholder in virtual host config with actual port
if [ -f /etc/apache2/sites-available/codeigniter.conf ]; then
	sed -i "s/\${PORT}/$PORT/g" /etc/apache2/sites-available/codeigniter.conf
fi

# Start Apache in foreground with logging to stdout
exec apache2ctl -D FOREGROUND
