FROM php:7.4-apache
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo pdo_mysql
RUN apt update  \
    && apt install emboss -y  \
    && apt install ncbi-blast+ -y \
    && apt-get clean \
    && apt-get autoclean \
    && a2enmod rewrite \
    && /etc/init.d/apache2 restart