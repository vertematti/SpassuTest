FROM php:8.3-apache AS backend_php

ARG NODE_VERSION
ARG BACKEND_PHP_IP

RUN echo "ServerName $BACKEND_PHP_IP" >> /etc/apache2/apache2.conf
CMD apachectl -DFOREGROUND

RUN addgroup --gid 1000 appuser
RUN adduser --uid 1000 --gid 1000 --disabled-password appuser
RUN adduser www-data appuser
RUN mkdir /home/appuser/bin

ENV ACCEPT_EULA=Y
ENV APACHE_ROOT_DIR=/var/www/html
ENV APACHE_DOCUMENT_ROOT=/var/www/html
ENV APACHE_LOG_DIR=/var/log
ENV APACHE_RUN_USER=appuser
ENV APACHE_RUN_GROUP=appuser

RUN a2dismod mpm_event
RUN a2enmod mpm_prefork rewrite expires ssl headers

RUN DEBIAN_FRONTEND=noninteractive apt-get update && apt-get install -y \
        git \
        zip \
        unzip \
        vim \
        curl \
        zlib1g-dev \
	libzip-dev \
        libpng-dev \
        libssl-dev \
        libicu-dev \
        libxml2-dev \
        libonig-dev \
        libxslt-dev \
        freetds-dev \
        apache2-utils \
        wget \
        apt-utils \
        xvfb \
        sqlite3 \
        libfontconfig \
        libltdl-dev \
        gnupg \
        redis-tools 
        
RUN ln -s /usr/include /usr/local/incl

RUN apt-get -y autoremove \
&& apt-get clean \
&& rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY laravel.conf /etc/apache2/sites-available/

RUN a2dissite 000-default.conf
RUN a2ensite laravel.conf

EXPOSE 80

USER appuser

RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.1/install.sh | bash
ENV NVM_DIR=/home/appuser/.nvm
RUN . "$NVM_DIR/nvm.sh" && nvm install ${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm use v${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm alias default v${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm install-latest-npm
ENV PATH="/home/appuser/.nvm/versions/node/v${NODE_VERSION}/bin/:${PATH}"

RUN npm install -g npm@latest

WORKDIR /var/www/html
