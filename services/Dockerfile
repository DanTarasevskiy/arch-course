FROM php:8.1-apache
WORKDIR /var/www/html
RUN a2enmod rewrite
RUN apt-get update && apt-get install -y \
    curl \
    zlib1g-dev \
    libzip-dev \
    unzip \
    zip \
    git \
    libpq-dev

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

RUN pecl update-channels \
    && pecl install -o -f redis \
    && pecl install mongodb \
    && echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/bin/ --filename=composer \
RUN composer install --prefer-source --no-interaction