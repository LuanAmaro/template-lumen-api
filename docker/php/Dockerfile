FROM php:8-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    build-essential \
    libzip-dev \
    libpq-dev \
    libpng-dev \
    git \
    zip \
    curl

RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear

RUN docker-php-ext-install pdo_mysql && \
    docker-php-ext-install pdo_pgsql && \
    docker-php-ext-install zip && \
    docker-php-ext-install exif && \
    docker-php-ext-install pcntl && \
    docker-php-ext-install gd && \
    docker-php-ext-enable redis

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer; \
    chmod +x /usr/local/bin/composer;

RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini && \
    sed -i "/post_max_size = .*/c\post_max_size = 1000M" /usr/local/etc/php/php.ini && \
    sed -i "/upload_max_filesize = .*/c\upload_max_filesize = 1000M" /usr/local/etc/php/php.ini

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY . /var/www

COPY --chown=www:www . /var/www

USER www

EXPOSE 9000

CMD ["php-fpm"]
