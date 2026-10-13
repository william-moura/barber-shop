FROM php:8.4-fpm-alpine

# Instala dependências do sistema e extensões PHP necessárias
RUN apk add --no-cache \
    bash \
    curl \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    postgresql-dev \
    $PHPIZE_DEPS

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql zip bcmath gd

# Copia o Composer da imagem oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www

# COPIA os arquivos do seu projeto para o container
COPY . /var/www

# Ajusta as permissões dos arquivos copiados para o usuário do PHP
RUN chown -R www-data:www-data /var/www

# Muda para o usuário não-root
USER www-data

# Executa o instalador do Composer (agora ele vai encontrar o composer.json)
RUN composer install --no-interaction --optimize-autoloader --no-dev

EXPOSE 9000

CMD ["php-fpm"]
