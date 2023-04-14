FROM php:7.4-apache

# Install required PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy website files into the container
COPY ./src/ /var/www/html/

# Copy Apache virtual host configuration into the container
COPY ./apache.conf /etc/apache2/sites-available/000-default.conf

# Copy PHP configuration into the container
COPY ./php.ini /usr/local/etc/php/php.ini