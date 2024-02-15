# Usa a imagem oficial do PHP com Apache
FROM php:8-apache

# Atualiza o sistema e instala as dependências necessárias
RUN apt-get update && \
  apt-get install -y \
  libzip-dev \
  unzip \
  libpq-dev \
  && docker-php-ext-install zip pdo pdo_mysql pdo_pgsql

# Habilita o mod_rewrite do Apache
RUN a2enmod rewrite

# Copia o código do projeto para o contêiner
COPY . /var/www/html

# Define o diretório de trabalho
WORKDIR /var/www/html

# Instala as dependências do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev

# Expõe a porta 80
EXPOSE 80

# Inicializa o Apache no modo foreground
CMD ["apache2-foreground"]
