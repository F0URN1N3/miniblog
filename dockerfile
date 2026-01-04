FROM php:8.2-apache

# 1. 安裝系統依賴
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    libzip-dev \
    unzip \
    libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql pdo_pgsql gd zip

RUN a2enmod rewrite

# 2. 複製程式碼
COPY . /var/www/html
WORKDIR /var/www/html

# 3. 安裝 Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 加上 --ignore-platform-reqs 避開環境版本檢查，這在部署時非常管用
RUN composer install --optimize-autoloader --no-scripts --ignore-platform-reqs

# 4. 設定目錄權限 (避免 Facade 報錯)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 5. Apache 設定
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 80

# 這裡就是我們自動執行指令的地方
# 1. 清理快取 2. 強制執行資料庫遷移 3. 啟動 Apache
CMD php artisan config:cache && \
    php artisan migrate --force && \
    apache2-foreground
