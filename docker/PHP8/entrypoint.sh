#!/bin/ash

set -e;

/usr/bin/supervisord -c /etc/supervisor/supervisord.conf;

php-fpm;
