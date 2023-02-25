FROM php:8.1.0-fpm

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev libpq-dev zip libzip-dev zip libssh-dev gnupg2 iputils-ping libpng-dev libjpeg-dev libfreetype6-dev curl dirmngr apt-transport-https lsb-release ca-certificates wget


RUN curl -sL https://deb.nodesource.com/setup_14.x | /bin/bash -

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -

RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN apt-get update && apt-get install -y yarn

RUN docker-php-ext-install intl opcache mysqli pdo pdo_mysql
RUN pecl install apcu
RUN docker-php-ext-enable apcu
RUN docker-php-ext-install pcntl
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip \
        bcmath \
        sockets

WORKDIR /var/www/symfony_docker

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt-get install symfony-cli
