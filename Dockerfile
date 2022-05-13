#agregamos imagen base:
FROM php:8.0.12-apache
#setear directorio de trabajo:
WORKDIR /usr/src/app
#copiar codigo fuente de folder actual a carpeta /var/www/html en el contenedor:
COPY . /var/www/html
#abrimos puerto 80
EXPOSE 80
#instalamos extension mysqli
RUN docker-php-ext-install mysqli
