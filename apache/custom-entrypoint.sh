#!/bin/bash

cd /var/www/html
composer install

# cp /var/www/html/.env.example /var/www/html/.env

apache2-foreground