FROM php:7.4-apache

RUN apt-get -y update && \
  apt-get -y install vim

RUN echo "phar.readonly=off" >> /usr/local/etc/php/conf.d/docker-php-ext-sodium.ini