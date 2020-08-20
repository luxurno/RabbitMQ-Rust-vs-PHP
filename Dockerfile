FROM php:7.4-cli

ARG PROJECT_DIR="/var/www"
ENV PROJECT_DIR=${PROJECT_DIR}

WORKDIR ${PROJECT_DIR}

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN alias composer="php -n /usr/local/bin/composer"

# Install vim
RUN apt-get update && apt-get install -y vim

# Install PHP extensions
RUN apt-get install -y \
      zlib1g-dev \
      libzip-dev \
      unzip
RUN docker-php-ext-install zip
RUN docker-php-ext-install sockets

# Instalation Rust languague
RUN apt-get update

RUN apt-get update && apt-get install -y libssl-dev
RUN curl https://sh.rustup.rs -sSf | bash -s -- -y
RUN echo 'source $HOME/.cargo/env' >> $HOME/.bashrc

# Coping files into container
COPY . ${PROJECT_DIR}

