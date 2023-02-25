ARG PHP_VERSION
FROM php:${PHP_VERSION}-fpm

###########################################################################
# Core System Installation
###########################

RUN apt-get update \
    && apt install -y \
    gosu \
    libcurl4-openssl-dev \
    libedit-dev \
    libssl-dev \
    libxml2-dev \
    libxtst6 \
    libxrender1 \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libmcrypt-dev \
    libc-client-dev \
    libkrb5-dev \
    libonig-dev \
    pkg-config \
    libfontconfig1 \
    software-properties-common \
    sudo \
    unzip \
    vim \
    acl \
    cron \
    libzip-dev \
    supervisor \
    && pecl install -n mcrypt

RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl
RUN docker-php-ext-install mbstring xml gd curl intl pcntl zip imap pdo_mysql
RUN docker-php-ext-enable mbstring xml gd curl intl pcntl zip imap mcrypt pdo_mysql
RUN apt-get clean
RUN rm -rf /var/lib/apt/lists/*
RUN gosu nobody true

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    rm composer-setup.php

###########################################################################
# Non-root user
################

ARG NON_ROOT_UID
ENV NON_ROOT_UID=${NON_ROOT_UID}

ARG APP_PATH
ENV APP_PATH=${APP_PATH}

RUN groupadd -g $NON_ROOT_UID www
RUN useradd -u $NON_ROOT_UID -ms /bin/bash -g www www

RUN echo "www ALL=(root) NOPASSWD:ALL" > /etc/sudoers.d/www && \
    chmod 0440 /etc/sudoers.d/www

USER www

###########################################################################
# Services, Configurations & Aliases
#####################################

COPY ./php/local.ini /usr/local/etc/php/conf.d/local.ini
COPY ./php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./supervisor.conf /etc/supervisor/conf.d/supervisord.conf

###########################################################################
# Workdir and Finalize
#######################

WORKDIR $APP_PATH

COPY . $APP_PATH
COPY --chown=www:www . $APP_PATH

COPY --chown=www:www ./entrypoint.sh /tmp

RUN chmod +x /tmp/entrypoint.sh

CMD ["php-fpm"]
ENTRYPOINT ["/tmp/entrypoint.sh"]