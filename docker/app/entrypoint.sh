#! /bin/bash

set -e
set -x

BASE_DIR="/var/www"
VENDOR_DIR="/var/www/vendor"
STORAGE_DIR="/var/www/storage"
BOOTSTRAP_DIR="/var/www/bootstrap"
STORAGE_DIRS=('app' 'logs' 'framework' 'framework/cache' 'framework/sessions' 'framework/views');

for i in "${STORAGE_DIRS[@]}"
do
    if [ ! -d $STORAGE_DIR/$i ]
    then
        mkdir -p "$STORAGE_DIR/$i";
    fi
done

## Bootstrap folder creation
mkdir -p "$BOOTSTRAP_DIR/cache";

## Run composer install if vendor dir not found
if [ ! -d $VENDOR_DIR ]
then
    mkdir $VENDOR_DIR
    composer install;
fi

sudo service supervisor start;

exec "$@"
