# Usa Ubuntu 22.04 como imagen base
FROM ubuntu:22.04

# Evitar interacciones y establecer zona horaria
ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=Europe/Madrid

# Instala Apache, PHP y extensiones necesarias
RUN apt-get update && apt-get install -y \
    apache2 \
    php \
    php-cli \
    php-mysql \
    php-sqlite3 \
    libapache2-mod-php \
    php-xml \
    php-mbstring \
    php-curl \
    php-zip \
    php-bcmath \
    php-tokenizer \
    php-pdo \
    php-pdo-mysql \
    php-pdo-sqlite \
    unzip \
#    && a2enmod php8.1 \
#    && a2enmod rewrite \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Habilitar extensiones PDO y mostrar errores en cualquier versión de PHP
RUN for ini in /etc/php/*/apache2/php.ini; do \
        echo "extension=pdo_mysql" >> $ini; \
        echo "extension=pdo_sqlite" >> $ini; \
        echo -e "display_errors = On\nerror_reporting = E_ALL" >> $ini; \
    done

# Detectar la versión de PHP instalada y habilitar el módulo en Apache
RUN PHP_VERSION=$(php -r "echo PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION;") \
    && a2enmod php${PHP_VERSION} \
    && a2enmod rewrite


# Habilitar extensiones PDO manualmente
#RUN echo "extension=pdo_mysql" >> /etc/php/8.1/apache2/php.ini \
#    && echo "extension=pdo_sqlite" >> /etc/php/8.1/apache2/php.ini \
#    && echo "display_errors = On\nerror_reporting = E_ALL" >> /etc/php/8.1/apache2/php.ini


ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2

EXPOSE 80

# Ajusta permisos y establece el usuario de Apache
RUN chown -R www-data:www-data /var/www/html

#Ejecutar Apache en primer plano
ENTRYPOINT ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]


