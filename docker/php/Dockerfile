FROM php:8.3-fpm

MAINTAINER Djalma Manfrin <djalma.manfrin@gmail.com>

# Atualiza pacotes e instala dependências
RUN apt-get update && apt-get upgrade -y \
    libonig-dev \
    libmcrypt-dev \
    zlib1g-dev \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    vim \
    curl \
    zip \
    && rm -rf /var/lib/apt/lists/*

# Instalando as bibliotecas PDO, GD, Zip, OpCache, Bcmath, Mbstring, Intl e a configuração do Xdebug
RUN echo "Instalando bibliotecas e extensões PHP" && \
    docker-php-ext-install pdo pdo_mysql gd zip opcache bcmath mbstring intl dom mysqli

# Instalando Xdebug
# Verificando se o Xdebug está instalado e, se não, instalando
RUN if ! php -m | grep -q 'xdebug'; then \
    pecl channel-update pecl.php.net && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug; \
    fi

# Configuração do Xdebug
COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Instalando o Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

# Configuração de timezone e memória
RUN echo "date.timezone=America/Sao_Paulo" > /usr/local/etc/php/conf.d/docker-php-ext-timezone_sao_paulo.ini && \
    echo "memory_limit = 1024M" > /usr/local/etc/php/conf.d/docker-php-ext-memory_limit.ini

EXPOSE 9000

VOLUME ["/var/www"]

CMD ["php-fpm"]
