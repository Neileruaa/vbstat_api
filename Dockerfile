FROM php:7.3-apache

RUN apt-get update;apt-get install -y git zip unzip apt-utils
RUN docker-php-ext-install pdo_mysql
COPY ./docker/php/php.ini /usr/local/etc/php/
COPY ./docker/apache/default.conf /etc/apache2/sites-available/000-default.conf
COPY . /var/www/html/
RUN mkdir -p /var/www/.cache && chown www-data /var/www/.cache && chgrp www-data /var/www/.cache
RUN mkdir -p /var/www/.config && chown www-data /var/www/.config && chgrp www-data /var/www/.config

WORKDIR /var/www/html

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'e5325b19b381bfd88ce90a5ddb7823406b2a38cff6bb704b0acc289a09c8128d4a8ce2bbafcd1fcbdc38666422fe2806') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

RUN composer install

#RUN rm -rf /var/www/html/var/cache/*; chmod -R 777 /var/www/html/var; chmod -R 777 /var/www/html/data



#RUN rm -rf /var/www/html/var/cache/*; chmod -R 777 /var/www/html/var; chmod -R 777 /var/www/html/data
EXPOSE 80
