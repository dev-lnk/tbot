FROM php:8.1-fpm

RUN apt-get update \
    && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libicu-dev \
    libmcrypt4 \
    libmcrypt-dev \
    libpng-dev \
    zlib1g-dev \
    libxml2-dev \
    libzip-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    libldap2-dev \
    libpq-dev \
    htop \
    wget \
    curl \
    bash \
    vim \
    zip \
    unzip
    #supervisor \

RUN docker-php-ext-install exif \
    && docker-php-ext-configure intl --enable-intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo \
    && docker-php-ext-install mysqli pdo_mysql \
    && docker-php-ext-install intl \
    && docker-php-ext-install iconv \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install zip \
    && docker-php-ext-install pcntl

#Установка composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#Установка redis
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

#Install xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

ARG docker_user
ENV user=${docker_user}
RUN useradd -o -u 1000 -g www-data -m -s /bin/bash ${user}

RUN chown -R www-data:www-data /var/www/
RUN chmod 777 -R /tmp && chmod o+t -R /tmp

RUN mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

COPY ./conf.d /usr/local/etc/php/conf.d

WORKDIR /var/www/t-bot.local

COPY entrypoint.sh /home/entrypoint.sh
RUN tr -d '\015' </home/entrypoint.sh >/home/entrypoints.sh
RUN chmod +x /home/entrypoints.sh
entrypoint "/home/entrypoints.sh"

USER ${user}
