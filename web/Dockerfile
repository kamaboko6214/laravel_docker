# ベースイメージ
FROM php:7.4-apache

# ローカルの設定ファイルをコンテナにコピー
COPY ./php/php.ini /usr/local/etc/php/
COPY ./apache/000-default.conf /etc/apache2/sites-enabled/

# ミドルウェアをインストール
RUN apt-get update && apt-get install -y \
    git zip unzip vim nano nodejs npm \
    libpng-dev libpq-dev libfreetype6-dev libjpeg62-turbo-dev \
&& docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
&& docker-php-ext-install -j$(nproc) gd pdo_mysql mysqli

# modRewriteを有効化する
RUN a2enmod rewrite

# Composerをインストール
WORKDIR /usr/bin
RUN curl -s http://getcomposer.org/installer | php \
&& ln -s /usr/bin/composer.phar /usr/bin/composer

# Laravelのインストーラをインストール
WORKDIR /var/www/html
RUN composer global require "laravel/installer"

# ポート80で通信
EXPOSE 80

# 既定コマンド
CMD ["apache2-foreground"]