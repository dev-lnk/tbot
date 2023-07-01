FROM php:8.1-fpm

RUN apt-get update
RUN apt-get install -y wget
RUN apt-get install -y curl
RUN apt-get install -y git
RUN apt-get install -y bash
RUN apt-get install -y vim
RUN apt-get install -y zip unzip
RUN apt-get install -y libfreetype6-dev
RUN apt-get install -y libjpeg62-turbo-dev
RUN apt-get install -y libicu-dev
RUN apt-get install -y libmcrypt4
RUN apt-get install -y libmcrypt-dev
RUN apt-get install -y libpng-dev
RUN apt-get install -y zlib1g-dev
RUN apt-get install -y libxml2-dev
RUN apt-get install -y libzip-dev
RUN apt-get install -y libonig-dev
RUN apt-get install -y libcurl4-openssl-dev
RUN apt-get install -y libldap2-dev
RUN apt-get install -y libpq-dev
RUN apt-get install -y htop

RUN docker-php-ext-configure intl --enable-intl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install pdo
RUN docker-php-ext-install mysqli pdo_mysql
RUN docker-php-ext-install intl iconv mbstring
RUN docker-php-ext-install zip pcntl
RUN docker-php-ext-install exif opcache
RUN docker-php-source delete

#Установка composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#Установка redis
RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis

#Install xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

#Install supervisor
#RUN apt-get install -y supervisor

ARG docker_user
ENV user=${docker_user}
RUN useradd -o -u 1000 -g www-data -m -s /bin/bash ${user}

RUN chown -R www-data:www-data /var/www/
RUN chmod 777 -R /tmp && chmod o+t -R /tmp

WORKDIR /var/www/t-bot.local

COPY entrypoint.sh /home/entrypoint.sh
RUN tr -d '\015' </home/entrypoint.sh >/home/entrypoints.sh
RUN chmod +x /home/entrypoints.sh
entrypoint "/home/entrypoints.sh"

USER ${user}
