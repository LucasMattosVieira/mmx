FROM php:7.3-apache 
RUN apt-get update
RUN apt-get install -y libzip-dev libjpeg62-turbo-dev libpng-dev libfreetype6-dev
# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install gd
RUN mkdir -p /app/mmx
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf 
WORKDIR /app/mmx
RUN chown -R www-data:www-data /app/mmx && a2enmod rewrite