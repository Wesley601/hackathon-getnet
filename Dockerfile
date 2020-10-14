FROM ambientum/php:7.4-nginx

COPY . /var/www/app

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --no-dev
