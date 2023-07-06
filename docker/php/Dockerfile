FROM php:8.1-fpm-alpine
RUN apk add --no-cache bash
RUN apk --update --no-cache add git
RUN docker-php-ext-install pdo_mysql
RUN apk add icu-dev
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN docker-php-ext-install sockets
RUN apk add --no-cache openssl-dev \
    && docker-php-ext-install ftp

RUN apk add libpng libpng-dev libjpeg-turbo-dev libwebp-dev zlib-dev libxpm-dev gd && docker-php-ext-install gd
RUN apk add libzip-dev zip && docker-php-ext-install zip

COPY --from=composer /usr/bin/composer /usr/bin/composer
WORKDIR /var/www

COPY php.ini /usr/local/etc/php/conf.d/custom.ini

CMD composer install ; -- bin/console doctrine:migrations:migrate ;  php-fpm

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

EXPOSE 9000
