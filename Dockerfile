# Используем официальный образ PHP 8.2
FROM php:8.2-cli-alpine

# Устанавливаем системные зависимости
RUN apk add --no-cache \
    git \
    curl \
    sqlite \
    sqlite-dev \
    libxml2-dev \
    oniguruma-dev \
    && docker-php-ext-install \
    pdo \
    pdo_sqlite \
    bcmath \
    opcache \
    && rm -rf /var/cache/apk/*

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Создаём рабочую директорию
WORKDIR /var/www/html

# Копируем файлы проекта
COPY . .

# Устанавливаем зависимости Laravel (без dev-зависимостей)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Создаём директорию для SQLite базы данных
RUN mkdir -p /var/www/html/database && \
    touch /var/www/html/database/database.sqlite && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Открываем порт (Railway использует переменную окружения PORT)
EXPOSE 8080

# Запускаем Laravel встроенным сервером с динамическим портом
# Кэшируем конфиги в runtime, чтобы переменные окружения Railway работали
CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
