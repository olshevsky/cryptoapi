FROM php:8.1-fpm-alpine
RUN apk update && apk add git libmcrypt-dev openssl libxml2-dev oniguruma-dev unixodbc-dev npm
RUN docker-php-ext-install pdo_mysql bcmath

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN addgroup -g 1000 www
RUN adduser -u 1000 -G www -h /bin/bash -D www

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
RUN su -l www
RUN chmod -R 755 /var/www/storage

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
