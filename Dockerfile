# Dockerfile
FROM php:8.2-fpm

# Cài các extension cần thiết
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl gd

# Cài Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Cấu hình nginx
COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf

# Sao chép mã nguồn
COPY . /var/www/html
WORKDIR /var/www/html

# Phân quyền
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Khởi động PHP + Nginx
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80
CMD ["/start.sh"]
