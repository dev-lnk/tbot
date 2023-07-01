#!/bin/bash

set -e;

#ADD YOUR CODE

#If supervisor install
#/usr/bin/supervisord;

php-fpm;

tail -f /home/entrypoints.sh;
