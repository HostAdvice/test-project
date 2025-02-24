#!/bin/bash
set -e

# Execute the default WordPress Docker entrypoint
exec docker-entrypoint.sh "$@" &
WP_PID=$!

# Wait for MySQL to be ready
until mysql -h"$WORDPRESS_DB_HOST" -u"$WORDPRESS_DB_USER" -p"$WORDPRESS_DB_PASSWORD" &> /dev/null
do
    echo "Waiting for database connection..."
    sleep 5
done

# Wait for WordPress to be ready
until $(curl --output /dev/null --silent --head --fail http://localhost); do
    echo "Waiting for WordPress to be ready..."
    sleep 5
done

# Install WordPress if not already installed
if ! $(wp core is-installed --allow-root); then
    echo "Installing WordPress..."
    wp core install --allow-root --url="$WORDPRESS_URL" --title="$WORDPRESS_TITLE" --admin_user="$WORDPRESS_ADMIN_USER" --admin_password="$WORDPRESS_ADMIN_PASSWORD" --admin_email="$WORDPRESS_ADMIN_EMAIL"
fi

# Set active theme
if [ -n "$WORDPRESS_THEME" ]; then
    echo "Setting active theme to $WORDPRESS_THEME..."
    wp theme activate --allow-root "$WORDPRESS_THEME"
fi

# Run migrations and seeds
if [ -f "/var/www/html/wp-content/themes/vpn-providers/scripts/migrate.php" ]; then
    php /var/www/html/wp-content/themes/vpn-providers/scripts/migrate.php
fi

# Keep container running
wait $WP_PID