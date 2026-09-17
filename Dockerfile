FROM php:8.1-apache

# Habilitar mod_rewrite do Apache para as rotas funcionarem
RUN a2enmod rewrite

# Instalar dependências necessárias para o SQLite e PHP
RUN apt-get update && apt-get install -y \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

# Configurar a pasta de trabalho
WORKDIR /var/www/html

# Copiar os arquivos do projeto para o container
COPY . /var/www/html/

# Ajustar permissões para que o Apache possa ler/escrever na pasta
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# O banco de dados SQLite vai precisar de um disco persistente no Render
# A pasta /var/www/html/db deve ser mapeada para um "Disk" no painel do Render.

EXPOSE 80