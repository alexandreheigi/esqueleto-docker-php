# Use a imagem oficial do PHP 8.1.22
FROM php:8.1.22-cli

# Instale as dependências necessárias
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    unzip \
    nano \
    && docker-php-ext-install pdo_mysql zip

# Instale o Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copie os arquivos do projeto para o contêiner
COPY . /var/www

# Configure o diretório de trabalho
WORKDIR /var/www

# Comando para iniciar seu projeto (por exemplo, servidor PHP)
CMD ["php", "-S", "0.0.0.0:8000"]