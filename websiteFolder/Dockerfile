FROM php:8.0-apache
COPY kioni/ /var/www/html/
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql