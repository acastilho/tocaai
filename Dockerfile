FROM php:8.3-fpm

# Instalar dependências
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip libpq-dev \
    libicu-dev gnupg && \
    docker-php-ext-install pdo pdo_pgsql bcmath gd intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# Garante permissões no script e nas pastas do Laravel
RUN chmod +x deploy.sh && \
    chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# Instala as dependências do PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction

EXPOSE 8000

# O Docker agora chama o nosso script de deploy
CMD ["./deploy.sh"]
