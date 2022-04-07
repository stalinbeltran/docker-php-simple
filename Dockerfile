FROM php:8.0.12-apache
#setear directorio de trabajo:
WORKDIR /usr/src/app
COPY . /var/www/html
EXPOSE 80
