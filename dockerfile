FROM php:8.2-apache

# 安裝必要的系統套件與 PHP 擴充 (支援 MySQL 和 Excel 處理)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    libzip-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd zip

# 開啟 Apache Rewrite 模組 (Laravel 路由必備)
RUN a2enmod rewrite

# 將專案程式碼複製進容器
COPY . /var/www/html

# 設定工作目錄
WORKDIR /var/www/html

# 安裝 Composer (並執行安裝)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 設定 Laravel 資料夾權限
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 將 Apache 指向 Laravel 的 public 資料夾
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 80
