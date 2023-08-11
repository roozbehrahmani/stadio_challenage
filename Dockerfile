FROM composer:latest as build
WORKDIR /app
COPY . /app

RUN composer install --ignore-platform-reqs

FROM php:8.1.9-fpm
COPY --from=build /app /app
WORKDIR /app

# Install tools
RUN set -eux; \
    apt-get update; \
    apt-get upgrade -yqq; \
    pecl channel-update pecl.php.net && \
    apt-get install -yqq --no-install-recommends \
    vim

# Install redis
RUN pecl install -o -f redis && \
 echo "extension=redis.so" > /usr/local/etc/php/conf.d/docker-php-ext-redis.ini && \
 rm -rf /tmp/pear

########################################################

COPY ./.env.example ./.env

RUN php artisan optimize:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan key:generate

RUN chown -R www-data:www-data /app
RUN chmod 777 -R /app/storage /app/bootstrap/cache

CMD php artisan serve --host=0.0.0.0 --port=8181

EXPOSE 8181


