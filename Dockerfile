FROM php:8.2-apacheMore 

RUN docker-php-ext-install pdo pdo_mysql

COPY app/ /var/www/html/
COPY apache.conf /etc/apache2/conf-enabled/custom.conf

EXPOSE 80