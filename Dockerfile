FROM php:8-apache-bullseye

WORKDIR /var/www/html
COPY src/ /var/www/html