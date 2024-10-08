# Этап 1: этап сборки
FROM php:8.3-fpm-alpine as build

# Установка системных зависимостей и php расширений
RUN apk add --no-cache \
    zip \
    libzip-dev \
    freetype \
    libjpeg-turbo \
    libpng \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    bash \
    nodejs \
    npm \
    nginx \
    postgresql-dev  \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip pdo pdo_pgsql \
    && docker-php-ext-configure gd --with-freetype=/usr/2include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-enable gd

# Установка composer
COPY --from=composer:2.7.6 /usr/bin/composer /usr/bin/composer


WORKDIR /app

COPY --chown=www-data:www-data ./project /app
#RUN  chown -R www-data:www-data /app
#RUN  chmod -R 775 .
#RUN  chmod -R ug+w storage

#RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache
#RUN chmod -R 775 /app/storage /app/bootstrap/cache

COPY ./deploy/nginx.conf /etc/nginx/http.d/default.conf

CMD ["sh", "-c", "nginx && php-fpm"]