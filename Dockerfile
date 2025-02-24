FROM wordpress:php8.1-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    libzip-dev \
    npm \
    && docker-php-ext-install zip pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install WP-CLI
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp

# Set working directory
WORKDIR /var/www/html

# Install composer dependencies
COPY composer.json ./
RUN composer install --ignore-platform-reqs

# Install yarn
RUN npm install -g yarn

# Copy package.json and yarn.lock
COPY package.json yarn.lock webpack.config.js ./

# Copy startup script
COPY docker-entrypoint-custom.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint-custom.sh

ENTRYPOINT ["docker-entrypoint-custom.sh"]
CMD ["apache2-foreground"]