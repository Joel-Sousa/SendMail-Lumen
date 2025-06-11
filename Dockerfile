FROM php:8.3-cli

# Instala extensões básicas
RUN apt-get update && apt-get install -y unzip git libzip-dev && docker-php-ext-install zip

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cria diretório do app
WORKDIR /app

# Copia os arquivos
COPY . .

# Instala dependências
RUN composer install --no-dev --optimize-autoloader

# Porta padrão
EXPOSE 8000

# Comando para iniciar o servidor
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
