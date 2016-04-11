#!/usr/bin/env bash

# Change to web root directory
cd /var/www

# Download and run Composer
wget http://getcomposer.org/composer.phar -O composer.phar
php composer.phar install --optimize-autoloader --prefer-dist

# Symfony commands
rm -rf web/bundles

case "$APP_RUN_MODE" in
  "prod")
    php bin/console assets:install --env=prod
    ;;

  "stage")
    php bin/console assets:install --env=prod
    ;;

  "dev")
    php bin/console cache:clear --env=dev
    php bin/console assets:install --env=dev
    ;;
esac

# Get rid of nasty root permissions
chown -R www-data:root . $APP_CACHE_DIR $APP_LOG_DIR
chmod -R 777 $APP_CACHE_DIR $APP_LOG_DIR

# Run Apache2
/usr/sbin/apache2ctl -D FOREGROUND
