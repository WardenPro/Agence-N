FROM php:fpm-alpine3.20 AS builder

RUN apk --no-cache add \
    gnupg \
    g++ \
    autoconf \
    make \
    zlib-dev \
    libzip-dev \
    freetype-dev \
    libpng-dev \
    jpeg-dev \
    icu-dev \
    oniguruma-dev \
    libxslt-dev \
    php-pear \
    libxml2-dev \
    curl-dev \
    sqlite-dev

RUN docker-php-ext-configure gd --with-jpeg --with-freetype && \
    docker-php-ext-install -j$(nproc) pdo pdo_mysql zip xsl gd intl opcache exif mbstring

RUN apk del gnupg g++ autoconf make

FROM php:fpm-alpine3.20

RUN apk --no-cache add \
    libpng \
    freetype \
    libjpeg-turbo \
    icu-libs \
    libxslt \
    libzip \
    bash \
    libc6-compat

COPY php.ini /usr/local/etc/php/conf.d/docker-php-config.ini

RUN apk --no-cache add \
    sudo \
    openssl \
    git \
    unzip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash && \
    apk add symfony-cli

COPY --from=builder /usr/local/lib/php/extensions/no-debug-non-zts-20230831/ /usr/local/lib/php/extensions/no-debug-non-zts-20230831/

COPY --from=builder /usr/local/etc/php/conf.d/ /usr/local/etc/php/conf.d/

COPY . /var/www/symfony
WORKDIR /var/www/symfony

CMD ["php-fpm"]
