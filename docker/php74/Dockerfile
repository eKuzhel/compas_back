FROM alpine:3.13

ENV TIMEZONE="Europe/Moscow"

RUN rm -rf /etc/localtime \
    && ln -s /usr/share/zoneinfo/$TIMEZONE /etc/localtime \
    && echo "${TIMEZONE}" > /etc/timezone

RUN adduser -D -u 1000 -g 'www' www && mkdir -p /app 

RUN apk update \
    && apk add \
    tzdata \
    php7-fpm \
    php7-mcrypt \
    php7-soap \
    php7-phar \
    php7-openssl \
    php7-cli \
    php7-gmp \
    php7-pdo_odbc \
    php7-json \
    php7-dom \
    php7-pdo \
    php7-zip \
    php7-mysqli \
    php7-exif \
    php7-session \
    php7-sqlite3 \
    php7-pdo_pgsql \
    php7-bcmath \
    php7-simplexml \
    php7-gd \
    php7-odbc \
    php7-pdo_mysql \
    php7-pdo_sqlite \
    php7-fileinfo \
    php7-mbstring \
    php7-redis \
    php7-gettext \
    php7-xmlreader \
    php7-tokenizer \
    php7-xmlwriter \
    php7-xmlrpc \
    php7-bz2 \
    php7-iconv \
    php7-pdo_dblib \
    php7-curl \
    php7-ctype \
    php7-apcu \
    php7-opcache \
    imagemagick \
    py3-setuptools \
    php7-imagick \
    && rm -rf /var/cache/apk/*

RUN sed -i "s|;listen.owner\s*=\s*nobody|listen.owner = www|g" /etc/php7/php-fpm.conf \
    && sed -i "s|;listen.group\s*=\s*nobody|listen.group = www|g" /etc/php7/php-fpm.conf \
    && sed -i "s|;listen.mode\s*=\s*0660|listen.mode = 0660|g" /etc/php7/php-fpm.conf \
    && sed -i "s|user\s*=\s*nobody|user = www|g" /etc/php7/php-fpm.conf \
    && sed -i "s|group\s*=\s*nobody|group = www|g" /etc/php7/php-fpm.conf \
    && sed -i "s|;log_level\s*=\s*notice|log_level = debug|g" /etc/php7/php-fpm.conf \
    && sed -i "s|;error_log\s*=\s*php_errors.log|log_level = \/var\/log\/php_log|g" /etc/php7/php-fpm.conf \
    && sed -i "s|;clear_env = no|clear_env = no|g" /etc/php7/php-fpm.conf \
    && sed -i 's/include\ \=\ \/etc\/php7\/fpm.d\/\*.conf/\;include\ \=\ \/etc\/php7\/fpm.d\/\*.conf/g' /etc/php7/php-fpm.conf

RUN touch /var/log/php7/warning.log && chown www:www /var/log/php7/warning.log && ln -sf /dev/stderr /var/log/php7/warning.log
RUN touch /var/log/php7/error.log && chown www:www /var/log/php7/error.log && ln -sf /dev/stdout /var/log/php7/error.log

COPY config/php.ini /etc/php7/php.ini
COPY config/www.conf /etc/php7/php-fpm.d/www.conf 

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/bin \
    && php -r "unlink('composer-setup.php');" \
    && mv /usr/bin/composer.phar /usr/bin/composer
	

CMD ["php-fpm7", "-F", "-c", "/etc/php7/php.ini"]

