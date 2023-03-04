FROM php:8.0.1-apache
ARG USER_ID
ARG GROUP_ID 
RUN groupadd -f -g $GROUP_ID user
RUN useradd -u $USER_ID -g $GROUP_ID user

WORKDIR /var/www/html
RUN apt-get update && apt-get install -y \
    libpng-dev \
    zlib1g-dev \
    libxml2-dev \
    libzip-dev \
    libonig-dev \
    zip \
    curl \
    unzip \
    sudo \
    yarn \
    libpq-dev \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip \
    && docker-php-ext-install  mbstring exif pcntl bcmath \
    && docker-php-source delete
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && curl -sL https://deb.nodesource.com/setup_14.x | sudo bash - \
    && sudo apt install -yq nodejs build-essential \
    && composer global require laravel/installer 
ENV PATH="$PATH:/root/.composer/vendor/bin"
RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite
USER user
# docker build -t mpts:laravel --build-arg USER_ID=$(id -u) --build-arg GROUP_ID=$(id -g) .docker 
