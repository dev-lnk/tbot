FROM php:8.1-fpm-alpine

RUN apk add --no-cache --update \
  bzip2-dev \
  enchant2-dev \
  libpng-dev \
  gmp-dev \
  imap-dev \
  icu-dev \
  openldap-dev \
  freetds-dev \
  libxml2-dev \
  tidyhtml-dev  \
  libxslt-dev \
  libzip-dev \
  musl-dev \
  supervisor \
  openrc

RUN docker-php-ext-install \
  bcmath \
  bz2 \
  calendar \
  exif \
  gd \
  gettext \
  gmp \
  imap \
  intl \
  ldap \
  mysqli \
  opcache \
  pcntl \
  pdo_mysql \
  xsl \
  zip

#Installing composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php

#Installing redis
RUN apk add --no-cache pcre-dev $PHPIZE_DEPS \
        && pecl install redis \
        && docker-php-ext-enable redis.so

#Installing xdebug
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS
RUN apk add --update linux-headers
RUN pecl install xdebug-3.1.5
RUN docker-php-ext-enable xdebug
RUN apk del -f .build-deps

RUN rm -rf /tmp/* /var/cache/apk/*

WORKDIR /var/www/t-bot.local

ARG docker_user
ENV user=${docker_user}
RUN adduser -D -u 1000 ${user}
RUN addgroup ${user} www-data
RUN chown -R www-data:www-data /var/www/

RUN mkdir -p /etc/supervisor/conf.d \
 && mkdir -p /var/log/supervisor

RUN chmod 777 -R /tmp && chmod o+t -R /tmp
RUN chmod 777 -R /var/log && chmod o+t -R /var/log
RUN chmod 777 -R /var/run && chmod o+t -R /var/run

RUN mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

COPY ./conf.d /usr/local/etc/php/conf.d

COPY supervisor/supervisord.conf /etc/supervisor/supervisord.conf

COPY entrypoint.sh /home/entrypoint.sh
RUN chmod 755 /home/entrypoint.sh
CMD ["/home/entrypoint.sh"]

USER ${user}