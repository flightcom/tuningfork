#!/bin/bash

echo -e "\n\n---> Running SETUP script"

ln -s /usr/bin/nodejs /usr/bin/node
cd /var/www/tuningfork

# Composer
echo -e "\n---> Installing Composer"
curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/usr/bin --version=1.0.0-alpha8
echo -e "\n---> Running Composer"
php composer.phar update

# Front-end libraries
## WHY SO LONG ?
# echo -e "\n---> Install JS dependencies"
# npm install
# npm rebuild node-sass
# bower install --allow-root

# Updating DB
echo -e "\n---> Updating database schema"
php application/doctrine.php orm:schema-tool:update --force
echo -e "\n---> Running migrations"
./vendor/bin/doctrine-migrations migrations:migrate --no-interaction

exit 0
