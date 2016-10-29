#!/bin/bash

# Updating data
cd /var/www/tuningfork
php application/doctrine.php orm:schema-tool:update --force
./vendor/bin/doctrine-migrations migrations:migrate --no-interaction

# Starting services
service mysql start
service php7.0-fpm start
service nginx start
supervisor -n
